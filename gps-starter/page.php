<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

//$content = get_fields();

get_header();

\GPS\Layouts\Layout_Factory::get_layouts("sections_hero", \GPS\Layouts\Layout_Factory::SECTIONS, \GPS\Layouts\Layout_Factory::HEADER);

\GPS\Layouts\Layout_Factory::get_layouts("sections_content", \GPS\Layouts\Layout_Factory::SECTIONS);

get_footer(); ?>