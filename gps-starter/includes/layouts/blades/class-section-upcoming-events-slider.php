<?php

namespace GPS\Layouts\Blades;

use GPS\Layouts as Layouts,
	GPS\Layouts\Blocks as Blocks;


/**
 * Upcoming Events Slider blade
 *
 * @author Patrick Jackson <patrickj@montanab.com>
 */
class Section_Upcoming_Events_Slider extends Blade {

	private static $carousel_idx = 0;
	private $blade_idx;

	public function __construct() {

		parent::__construct();

		$this->blade_idx = parent::$blade_count;

		$bg_color   = get_sub_field( 'background_color' );
		$btn        = get_sub_field( 'button' );
		$foreground = get_sub_field( 'foreground' );
		$class      = get_sub_field( 'class' );
		?>

        <section id="blade-<?= $this->blade_idx ?>"
                 class="blade blade-upcoming-events bg-<?= $bg_color ?> fg-<?= $foreground ?> <?= $class ?>">
            <div class="container container-wide">
                <div class="row eyebrow-and-button">
					<?php if ( get_sub_field( 'section_heading' ) ): ?>
                        <div class="block block-eyebrow">
                            <h2 class="eyebrow"><?= get_sub_field( 'section_heading' ) ?></h2>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $btn ) ): ?>
                        <div class="desktop-only">
							<?php Layouts\Elements::button_element( $btn ); ?>
                        </div>
					<?php endif; ?>
                </div>
            </div>

            <div class="container">
                <div class="row row-carousel">
					<?php self::get_events_carousel( intval( get_sub_field( 'max_events' ) ) ); ?>
                </div>
                <div class="row row-carousel-navigation">
                    <div class="carousel-navigation">
                        <button type="button" class="carousel-prev"><i class="fal fa-long-arrow-left"></i></button>
                        <div class="carousel-dots"></div>
                        <button type="button" class="carousel-next"><i class="fal fa-long-arrow-right"></i></button>
                    </div>
                </div>

				<?php if ( ! empty( $btn ) ): ?>
                    <div class="row">
                        <div class="block block-button mobile-only col col-12">
							<?php Layouts\Elements::button_element( $btn ); ?>
                        </div>
                    </div>
				<?php endif; ?>
            </div>
        </section>

		<?php
	}

	/**
	 * Get Events Carousel
	 *
	 * Pull events from DB and output layout
	 *
	 * @param int $max_events maximum number of events to include in the carousel
	 */
	private static function get_events_carousel( $max_events ) {

		$args = array(
			'post_type'      => 'mcm_event',
			'post_status'    => 'publish',
			'posts_per_page' => $max_events,
			'meta_key'       => 'dates_0_date',
			'meta_query'     => array(
				array(
					'key' => 'expires',
				),
				array(
					'key'     => 'expires',
					'value'   => date( 'Ymd' ),
					'compare' => '>=',
				),
			),
			'orderby'        => 'meta_value',
			'order'          => 'ASC',
		);

		$latest_events = get_posts( $args );
		$slide_idx     = 0;

		?>

        <div id="carousel-<?= self::$carousel_idx ?>" class="carousel">
			<?php
			foreach ( $latest_events as $event_post ):
				$event = get_fields( $event_post->ID );
				?>
                <a href="<?= get_permalink( $event_post->ID ) ?>">
                    <div class="carousel-slide event-slide slide-<?= $slide_idx ?>">
						<?php
						$months = self::get_event_month_range( $event );
						$days   = self::get_event_day_range( $event );
						?>
                        <div class="event-month"><?= $months ?></div>
                        <div class="event-days"><?= $days ?></div>
                        <div class="event-location"><?= $event['location'] ?></div>
                        <h3 class="event-title"><?= $event_post->post_title ?></h3>
                    </div>
                </a>

			<?php endforeach; ?>

			<?php // for mobile, slides have a pair of events in a column
			/*$even = 0;
			foreach ( $latest_events as $event_post ):
				$event_pair[ $even ] = get_fields( $event_post->ID );
				if ( ! $even ) {
					$even = 1;
					continue;
				} else {
					$even = 0;
					$event_pair = [];
				}

				?>
                <div class="carousel-slide event-slide slide-<?= $slide_idx ?> mobile-only">
					<?php foreach ( $event_pair as $event ): ?>
                        <div class="slide-col">
                            <a href="<?= get_permalink( $event_post->ID ) ?>">
                                <div class="slide-content">
									<?php
									$months = self::get_event_month_range( $event );
									$days   = self::get_event_day_range( $event );
									?>
                                    <div class="event-month"><?= $months ?></div>
                                    <div class="event-days"><?= $days ?></div>
                                    <div class="event-location"><?= $event['location'] ?></div>
                                    <h3 class="event-title"><?= $event_post->post_title ?></h3>
                                </div>
                            </a>
                        </div>
					<?php endforeach; ?>
                </div>

			<?php endforeach; */ ?>


        </div>

		<?php self::$carousel_idx ++;

	}

	/**
	 * get string indicating the event month range
	 */
	private static function get_event_month_range( $event ) {
		foreach ( $event['dates'] AS $date ) {
			$date          = preg_replace( "/\//", "-", $date['date'] );
			$event_dates[] = date( "m/d/Y", strtotime( $date ) );
		}

		$num_dates   = count( $event_dates );
		$first_month = date( "F", strtotime( $event_dates[0] ) );
		$last_month  = date( "F", strtotime( $event_dates[ $num_dates - 1 ] ) );

		if ( $first_month == $last_month ) {
			return $first_month;
		} else {
			return date( "M", strtotime( $event_dates[0] ) ) . '/' . $last_month = date( "M", strtotime( $event_dates[ $num_dates - 1 ] ) );
		}
	}

	/**
	 * get string indicating the first and last day of the month
	 */
	private static function get_event_day_range( $event ) {

		foreach ( $event['dates'] AS $date ) {
			$date          = preg_replace( "/\//", "-", $date['date'] );
			$event_dates[] = date( "m/d/Y", strtotime( $date ) );
		}

		$num_dates = count( $event_dates );
		$days_str  = date( "j", strtotime( $event_dates[0] ) );
		$days_str  .= 1 < $num_dates ? '-' . date( "j", strtotime( $event_dates[ $num_dates - 1 ] ) ) : '';

		return $days_str;
	}

}