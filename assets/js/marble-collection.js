/**
 * Marble Collection Display JavaScript
 * Handles filtering, sorting, and AJAX functionality
 *
 * @package Marble_Collection_Display
 */

(function($) {
    'use strict';
    
    /**
     * Marble Collection Display Handler
     */
    var MarbleCollection = {
        
        /**
         * Initialize
         */
        init: function() {
            this.wrapper = $('.marble-collection-wrapper');
            
            if (this.wrapper.length === 0) {
                return;
            }
            
            this.container = this.wrapper.find('.mcd-products-container');
            this.loadingEl = this.wrapper.find('.mcd-loading');
            this.resultCount = this.wrapper.find('.mcd-result-count');
            
            this.bindEvents();
            this.loadProducts();
        },
        
        /**
         * Bind events
         */
        bindEvents: function() {
            var self = this;
            
            // Search form
            this.wrapper.on('submit', '.mcd-search-form', function(e) {
                e.preventDefault();
                self.loadProducts();
            });
            
            // Category filter
            this.wrapper.on('change', 'input[name="mcd_category"]', function() {
                self.loadProducts();
            });
            
            // Color filter
            this.wrapper.on('change', 'input[name="mcd_color"]', function() {
                self.loadProducts();
            });
            
            // Sorting
            this.wrapper.on('change', '.mcd-orderby', function() {
                self.loadProducts();
            });
            
            // Pagination
            this.wrapper.on('click', '.mcd-pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var page = self.getParameterByName('paged', url) || 1;
                self.loadProducts(page);
                
                // Scroll to top of products
                $('html, body').animate({
                    scrollTop: self.wrapper.offset().top - 100
                }, 500);
            });
        },
        
        /**
         * Load products via AJAX
         */
        loadProducts: function(page) {
            var self = this;
            page = page || 1;
            
            // Check if mcdAjax is defined
            if (typeof mcdAjax === 'undefined') {
                self.container.html('<p class="mcd-no-products">Configuration error. Please refresh the page.</p>');
                return;
            }
            
            // Get filter values
            var category = this.wrapper.find('input[name="mcd_category"]:checked').val() || '';
            var colors = [];
            this.wrapper.find('input[name="mcd_color"]:checked').each(function() {
                colors.push($(this).val());
            });
            var search = this.wrapper.find('.mcd-search-field').val() || '';
            var orderby = this.wrapper.find('.mcd-orderby').val() || 'menu_order';
            
            // Get settings
            var columns = this.wrapper.data('columns') || 3;
            var perPage = this.wrapper.data('per-page') || 24;
            
            // Show loading
            this.container.addClass('mcd-is-loading');
            this.loadingEl.show();
            
            // AJAX request
            $.ajax({
                url: mcdAjax.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'mcd_filter_products',
                    nonce: mcdAjax.nonce,
                    category: category,
                    color: colors.join(','),
                    search: search,
                    orderby: orderby,
                    paged: page,
                    per_page: perPage,
                    columns: columns
                },
                success: function(response) {
                    if (response.success && response.data && response.data.html) {
                        self.container.html(response.data.html);
                        self.updateResultCount(response.data.found_posts);
                    } else {
                        self.container.html('<p class="mcd-no-products">No products found.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    self.container.html('<p class="mcd-no-products">Error loading products. Please try again.</p>');
                },
                complete: function() {
                    self.container.removeClass('mcd-is-loading');
                    self.loadingEl.hide();
                }
            });
        },
        
        /**
         * Update result count
         */
        updateResultCount: function(count) {
            var text = count + ' ' + (count === 1 ? 'product' : 'products') + ' found';
            this.resultCount.text(text);
        },
        
        /**
         * Get URL parameter
         */
        getParameterByName: function(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }
    };
    
    /**
     * Initialize on document ready
     */
    $(document).ready(function() {
        MarbleCollection.init();
    });
    
})(jQuery);
