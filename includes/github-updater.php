<?php
/**
 * GitHub Plugin Updater
 * Allows plugin to be updated from GitHub repository
 *
 * @package Marble_Collection_Display
 */

if (!defined('ABSPATH')) {
    exit;
}

class MCD_GitHub_Updater {
    
    private $file;
    private $plugin;
    private $basename;
    private $active;
    private $username;
    private $repository;
    private $github_response;
    
    public function __construct($file) {
        $this->file = $file;
        $this->plugin = plugin_basename($this->file);
        
        add_filter('pre_set_site_transient_update_plugins', array($this, 'modify_transient'), 10, 1);
        add_filter('plugins_api', array($this, 'plugin_popup'), 10, 3);
        add_filter('upgrader_post_install', array($this, 'after_install'), 10, 3);
        
        // GitHub repository details
        $this->username = 'imranniaz-st';
        $this->repository = 'wo-com-all-comllection';
        $this->basename = plugin_basename($this->file);
        $this->active = is_plugin_active($this->basename);
    }
    
    /**
     * Get information from GitHub
     */
    private function get_repository_info() {
        if (is_null($this->github_response)) {
            $request_uri = sprintf('https://api.github.com/repos/%s/%s/releases/latest', $this->username, $this->repository);
            
            $response = wp_remote_get($request_uri);
            
            if (is_wp_error($response)) {
                return false;
            }
            
            $response = json_decode(wp_remote_retrieve_body($response), true);
            
            if (is_array($response)) {
                $response['sections'] = array(
                    'description' => 'Professional WooCommerce product collection display plugin for marble and stone products.',
                    'changelog' => isset($response['body']) ? $response['body'] : 'No changelog available'
                );
            }
            
            $this->github_response = $response;
        }
    }
    
    /**
     * Modify the transient to include our plugin
     */
    public function modify_transient($transient) {
        if (empty($transient->checked)) {
            return $transient;
        }
        
        $this->get_repository_info();
        
        if (isset($this->github_response['tag_name'])) {
            $version = str_replace('v', '', $this->github_response['tag_name']);
            
            if (version_compare(MCD_VERSION, $version, '<')) {
                $plugin = array(
                    'slug' => $this->basename,
                    'new_version' => $version,
                    'url' => $this->github_response['html_url'],
                    'package' => $this->github_response['zipball_url'],
                );
                
                $transient->response[$this->basename] = (object) $plugin;
            }
        }
        
        return $transient;
    }
    
    /**
     * Plugin popup details
     */
    public function plugin_popup($result, $action, $args) {
        if ($action !== 'plugin_information' || !isset($args->slug) || $args->slug !== $this->basename) {
            return $result;
        }
        
        $this->get_repository_info();
        
        $plugin = array(
            'name' => 'Marble Collection Display',
            'slug' => $this->basename,
            'version' => str_replace('v', '', $this->github_response['tag_name']),
            'author' => '<a href="https://bicodev.com">Bicodev Ltd</a>',
            'homepage' => $this->github_response['html_url'],
            'requires' => '5.8',
            'tested' => '6.4',
            'downloaded' => 0,
            'last_updated' => $this->github_response['published_at'],
            'sections' => array(
                'description' => 'Professional WooCommerce product collection display plugin for marble and stone products with advanced filtering, responsive design, and Elementor support.',
                'changelog' => isset($this->github_response['body']) ? $this->github_response['body'] : 'No changelog available',
            ),
            'download_link' => $this->github_response['zipball_url']
        );
        
        return (object) $plugin;
    }
    
    /**
     * After install
     */
    public function after_install($response, $hook_extra, $result) {
        global $wp_filesystem;
        
        $install_directory = plugin_dir_path($this->file);
        $wp_filesystem->move($result['destination'], $install_directory);
        $result['destination'] = $install_directory;
        
        if ($this->active) {
            activate_plugin($this->basename);
        }
        
        return $result;
    }
}
