<?php
/**
 * The header for our theme
 *
 * @package Xequence
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <style>
        body {
            background-color: #0f172a;
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(30, 58, 138, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(14, 165, 233, 0.1) 0%, transparent 50%);
            background-size: 100% 100%;
            background-attachment: fixed;
        }
        .code-gradient {
            background: linear-gradient(90deg, #14b8a6, #0ea5e9);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .glow {
            box-shadow: 0 0 20px rgba(20, 184, 166, 0.2);
        }
        .btn-hover {
            transition: all 0.3s ease;
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }
        
        /* Mega Menu Styles */
        .mega-menu {
            display: none;
            position: absolute;
            left: 0;
            width: 100%;
            padding: 2rem 0;
            background-color: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(51, 65, 85, 0.5);
            z-index: 50;
        }
        
        .has-mega-menu:hover .mega-menu {
            display: block;
        }
        
        /* Dropdown Menu Styles */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 200px;
            background-color: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(51, 65, 85, 0.5);
            border-radius: 0.5rem;
            padding: 0.5rem 0;
            z-index: 50;
        }
        
        .has-dropdown:hover .dropdown-menu {
            display: block;
        }
        
        /* Sticky Header */
        .sticky-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 100;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        
        .sticky-header.scrolled {
            background-color: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>

<body <?php body_class('font-sans text-gray-100'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col">
    <header id="masthead" class="site-header sticky-header py-4">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <div class="site-branding flex items-center">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center bg-dark-900 border border-primary-700/30 rounded-xl p-2 glow">
                        <?php if (has_custom_logo()): ?>
                            <?php the_custom_logo(); ?>
                        <?php else: ?>
                            <span class="font-mono font-bold text-xl text-white"><?php bloginfo('name'); ?></span>
                        <?php endif; ?>
                    </a>
                </div>

                <nav id="site-navigation" class="main-navigation hidden lg:block">
                    <ul class="flex space-x-1">
                        <li class="has-mega-menu relative group">
                            <a href="/platform" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                Platform
                                <i class="fas fa-chevron-down ml-1 text-xs"></i>
                            </a>
                            <div class="mega-menu">
                                <div class="container mx-auto px-4">
                                    <div class="grid grid-cols-3 gap-8">
                                        <div>
                                            <h3 class="text-lg font-bold mb-4">Core Features</h3>
                                            <ul class="space-y-2">
                                                <li>
                                                    <a href="/features/code-sharing" class="flex items-center text-gray-300 hover:text-primary-400 transition-colors">
                                                        <i class="fas fa-code mr-2 text-primary-400"></i>
                                                        Interactive Code Sharing
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/features/version-control" class="flex items-center text-gray-300 hover:text-primary-400 transition-colors">
                                                        <i class="fas fa-code-branch mr-2 text-primary-400"></i>
                                                        Version Control Integration
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/features/ai-discovery" class="flex items-center text-gray-300 hover:text-primary-400 transition-colors">
                                                        <i class="fas fa-lightbulb mr-2 text-primary-400"></i>
                                                        AI-Powered Discovery
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/features/community" class="flex items-center text-gray-300 hover:text-primary-400 transition-colors">
                                                        <i class="fas fa-users mr-2 text-primary-400"></i>
                                                        Developer Community
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold mb-4">Solutions</h3>
                                            <ul class="space-y-2">
                                                <li>
                                                    <a href="/solutions/teams" class="flex items-center text-gray-300 hover:text-primary-400 transition-colors">
                                                        <i class="fas fa-user-friends mr-2 text-primary-400"></i>
                                                        For Teams
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/solutions/enterprise" class="flex items-center text-gray-300 hover:text-primary-400 transition-colors">
                                                        <i class="fas fa-building mr-2 text-primary-400"></i>
                                                        For Enterprise
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/solutions/education" class="flex items-center text-gray-300 hover:text-primary-400 transition-colors">
                                                        <i class="fas fa-graduation-cap mr-2 text-primary-400"></i>
                                                        For Education
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/solutions/startups" class="flex items-center text-gray-300 hover:text-primary-400 transition-colors">
                                                        <i class="fas fa-rocket mr-2 text-primary-400"></i>
                                                        For Startups
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div>
                                            <div class="bg-dark-800/70 rounded-xl p-4 border border-gray-700/50">
                                                <h3 class="text-lg font-bold mb-2">Get Started Today</h3>
                                                <p class="text-gray-300 mb-4">Experience the power of Xequence for your development team.</p>
                                                <a href="/demo" class="btn-hover bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium px-4 py-2 rounded-lg inline-flex items-center">
                                                    Request a Demo
                                                    <i class="fas fa-arrow-right ml-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="has-dropdown relative group">
                            <a href="/pricing" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                Pricing
                            </a>
                        </li>
                        <li class="has-dropdown relative group">
                            <a href="#" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                Resources
                                <i class="fas fa-chevron-down ml-1 text-xs"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/blog" class="block px-4 py-2 text-gray-300 hover:text-primary-400 hover:bg-dark-800/50 transition-colors">
                                        Blog
                                    </a>
                                </li>
                                <li>
                                    <a href="/documentation" class="block px-4 py-2 text-gray-300 hover:text-primary-400 hover:bg-dark-800/50 transition-colors">
                                        Documentation
                                    </a>
                                </li>
                                <li>
                                    <a href="/tutorials" class="block px-4 py-2 text-gray-300 hover:text-primary-400 hover:bg-dark-800/50 transition-colors">
                                        Tutorials
                                    </a>
                                </li>
                                <li>
                                    <a href="/community" class="block px-4 py-2 text-gray-300 hover:text-primary-400 hover:bg-dark-800/50 transition-colors">
                                        Community
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-dropdown relative group">
                            <a href="#" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                Company
                                <i class="fas fa-chevron-down ml-1 text-xs"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/about" class="block px-4 py-2 text-gray-300 hover:text-primary-400 hover:bg-dark-800/50 transition-colors">
                                        About Us
                                    </a>
                                </li>
                                <li>
                                    <a href="/careers" class="block px-4 py-2 text-gray-300 hover:text-primary-400 hover:bg-dark-800/50 transition-colors">
                                        Careers
                                    </a>
                                </li>
                                <li>
                                    <a href="/contact" class="block px-4 py-2 text-gray-300 hover:text-primary-400 hover:bg-dark-800/50 transition-colors">
                                        Contact
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>

                <div class="flex items-center space-x-4">
                    <div class="hidden lg:block">
                        <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                            <div class="relative">
                                <input type="search" class="bg-dark-800/70 border border-gray-700/50 rounded-lg px-4 py-2 pl-10 text-white focus:outline-none focus:border-primary-500 w-48" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </form>
                    </div>
                    
                    <a href="/login" class="hidden lg:inline-flex items-center text-gray-300 hover:text-primary-400 transition-colors">
                        <i class="fas fa-sign-in-alt mr-1"></i>
                        Log In
                    </a>
                    
                    <a href="/signup" class="btn-hover bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium px-4 py-2 rounded-lg hidden lg:inline-flex items-center">
                        Get Started
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    
                    <button id="mobile-menu-toggle" class="text-white lg:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden mt-4 lg:hidden">
                <nav class="mobile-navigation">
                    <ul class="space-y-2">
                        <li>
                            <button class="mobile-dropdown-toggle flex items-center justify-between w-full px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                Platform
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <ul class="mobile-dropdown-menu hidden pl-4 mt-2 space-y-2">
                                <li>
                                    <a href="/features/code-sharing" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                        Interactive Code Sharing
                                    </a>
                                </li>
                                <li>
                                    <a href="/features/version-control" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                        Version Control Integration
                                    </a>
                                </li>
                                <li>
                                    <a href="/features/ai-discovery" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                        AI-Powered Discovery
                                    </a>
                                </li>
                                <li>
                                    <a href="/features/community" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                        Developer Community
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="/pricing" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                Pricing
                            </a>
                        </li>
                        <li>
                            <button class="mobile-dropdown-toggle flex items-center justify-between w-full px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                Resources
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <ul class="mobile-dropdown-menu hidden pl-4 mt-2 space-y-2">
                                <li>
                                    <a href="/blog" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                        Blog
                                    </a>
                                </li>
                                <li>
                                    <a href="/documentation" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                        Documentation
                                    </a>
                                </li>
                                <li>
                                    <a href="/tutorials" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                        Tutorials
                                    </a>
                                </li>
                                <li>
                                    <a href="/community" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                        Community
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <button class="mobile-dropdown-toggle flex items-center justify-between w-full px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                Company
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <ul class="mobile-dropdown-menu hidden pl-4 mt-2 space-y-2">
                                <li>
                                    <a href="/about" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                        About Us
                                    </a>
                                </li>
                                <li>
                                    <a href="/careers" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                        Careers
                                    </a>
                                </li>
                                <li>
                                    <a href="/contact" class="block px-4 py-2 text-gray-300 hover:text-primary-400 transition-colors">
                                        Contact
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                
                <div class="mt-4 space-y-4">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="relative">
                            <input type="search" class="w-full bg-dark-800/70 border border-gray-700/50 rounded-lg px-4 py-2 pl-10 text-white focus:outline-none focus:border-primary-500" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </form>
                    
                    <div class="flex space-x-4">
                        <a href="/login" class="flex-1 text-center px-4 py-2 border border-gray-700 rounded-lg text-gray-300 hover:text-primary-400 hover:border-primary-400 transition-colors">
                            Log In
                        </a>
                        <a href="/signup" class="flex-1 text-center btn-hover bg-gradient-to-r from-primary-600 to-primary-500 text-white font-medium px-4 py-2 rounded-lg">
                            Sign Up
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
