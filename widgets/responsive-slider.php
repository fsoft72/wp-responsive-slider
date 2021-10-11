<?php

namespace Elementor;

class Responsive_Slider extends Widget_Base {


	public function get_name() {
		return 'wp-responsive-slider';
	}

	public function get_title() {
		return __('Responsive Slider', 'wp-responsive-slider');
	}

	public function get_icon() {
		return 'eicon-media-carousel';
	}

	public function get_categories() {
		return ['wp-responsive-slider'];
	}
	public function get_keywords() {
		return ['slider', 'carousel', 'image', 'image-slider', 'image-carousel'];
	}
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section_layout',
			[
				'label' => __('Layout', 'wp-responsive-slider'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'item_height',
			[
				'label'         => __('Slider Height', 'wp-responsive-slider'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%', 'vh'],
				'range'         => [
					'px'        => [
						'min'   => 200,
						'max'   => 800,
						'step'  => 1,
					],
					'%'         => [
						'min'   => 0,
						'max'   => 100,
					],
				],
				'default'       => [
					'unit'      => 'vh',
					'size'      => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-container' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'          => __('Columns', 'wp-responsive-slider'),
				'type'           => Controls_Manager::SELECT,
				'default'        => 1,
				'tablet_default' => 1,
				'mobile_default' => 1,
				'options'        => [
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
					5 => '5',
					6 => '6',
				],
			]
		);
		$this->add_responsive_control(
			'item_gap',
			[
				'label'   => __('Slide Gap', 'wp-responsive-slider'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'tablet_default' => [
					'size' => 1,
				],
				'mobile_default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'render_template' => 'ui'
			]
		);
		$this->add_control(
			'overlay_color',
			[
				'label'     => __('Overlay Color', 'wp-responsive-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .slide-inner:before' => 'background: {{VALUE}}',
				],
				// 'default' => '#0798FA5E'
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Slides', 'wp-responsive-slider'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'image_background',
			[
				'label' => __('Color', 'wp-responsive-slider'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'description' => esc_html__('Colors property will visible only transparent image', 'wp-responsive-slider')
			]
		);
		$repeater->add_control(
			'slide_image',
			[
				'label'     => __('Image', 'wp-responsive-slider'),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url'   => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'image_size',
			[
				'label'      => __('Image Size', 'wp-responsive-slider'),
				'type'       => Controls_Manager::SELECT,
				'options'    => [
					'auto' => __('Default', 'wp-responsive-slider'),
					'contain'   => __('Contain', 'wp-responsive-slider'),
					'Cover'  => __('Cover', 'wp-responsive-slider'),
				],
				'default'    => 'auto',
				'dynamic'    => ['active' => true],
			]
		);
		$repeater->add_control(
			'image_horizontal_position',
			[
				'label'         => __('Horizontal Position', 'wp-responsive-slider'),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'      => [
						'title' => __('Left', 'wp-responsive-slider'),
						'icon'  => 'eicon-h-align-left',
					],
					'center'    => [
						'title' => __('Center', 'wp-responsive-slider'),
						'icon'  => 'eicon-h-align-center',
					],
					'right'     => [
						'title' => __('Right', 'wp-responsive-slider'),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'       => 'center',
				'toggle'        => false,
			]
		);
		$repeater->add_control(
			'image_vertical_position',
			[
				'label'         => __('Vertical Position', 'wp-responsive-slider'),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'top'      => [
						'title' => __('Top', 'wp-responsive-slider'),
						'icon'  => 'eicon-v-align-top',
					],
					'center'    => [
						'title' => __('Center', 'wp-responsive-slider'),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom'     => [
						'title' => __('Bottom', 'wp-responsive-slider'),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default'       => 'center',
				'toggle'        => false,
			]
		);
		$this->add_control(
			'slides_items',
			[
				'label' => __('Slides', 'wp-responsive-slider'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__('Slider Item #1', 'wp-responsive-slider'),
						'slide_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'image_background' => __('#FFF', 'wp-responsive-slider'),
						'image_horizontal_position' => esc_html__('center', 'wp-responsive-slider'),
						'image_vertical_position' => esc_html__('center', 'wp-responsive-slider'),
					],
					[
						'title' => esc_html__('Slider Item #2', 'wp-responsive-slider'),
						'slide_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'image_background' => __('#FFF', 'wp-responsive-slider'),
						'image_horizontal_position' => esc_html__('center', 'wp-responsive-slider'),
						'image_vertical_position' => esc_html__('center', 'wp-responsive-slider'),
					],
					[
						'title' => esc_html__('Slider Item #3', 'wp-responsive-slider'),
						'slide_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'image_background' => __('#FFF', 'wp-responsive-slider'),
						'image_horizontal_position' => esc_html__('center', 'wp-responsive-slider'),
						'image_vertical_position' => esc_html__('center', 'wp-responsive-slider'),
					],
				],
				'separator' => 'after'
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_carousel_settings',
			[
				'label' => __('Slider Options', 'wp-responsive-slider'),
			]
		);
		$this->add_control(
			'navigation',
			[
				'label'        => __('Navigation', 'wp-responsive-slider'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'arrows',
				'options'      => [
					'arrows'          => esc_html__('Arrows', 'wp-responsive-slider'),
					'dots'            => esc_html__('Dots', 'wp-responsive-slider'),
					'both'            => esc_html__('Arrows and Dots', 'wp-responsive-slider'),
					'arrows-fraction' => esc_html__('Arrows and Fraction', 'wp-responsive-slider'),
					'progressbar'     => esc_html__('Progress', 'wp-responsive-slider'),
					'none'            => esc_html__('None', 'wp-responsive-slider'),
				],
				'prefix_class' => 'wp-navigation-type-',
				'render_type'  => 'template',
			]
		);
		$this->add_control(
			'progress_position',
			[
				'label'     => __('Progress Position', 'wp-responsive-slider'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'bottom',
				'options'   => [
					'bottom' => esc_html__('Bottom', 'wp-responsive-slider'),
					'top'    => esc_html__('Top', 'wp-responsive-slider'),
				],
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);


		$this->add_control(
			'transition',
			[
				'label'        => esc_html__('Transition', 'wp-responsive-slider'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'slide',
				'options'      => [
					'fade'  => esc_html__('Fade', 'wp-responsive-slider'),
					'slide'  => esc_html__('Slide', 'wp-responsive-slider'),
					'coverflow' => esc_html__('Coverflow', 'wp-responsive-slider'),
				],
				'prefix_class' => 'wp-carousel-style-',
				'render_type'  => 'template',
				'separator'    => 'before'
			]
		);
		$this->add_control(
			'speed',
			[
				'label'   => __('Transition Speed (ms)', 'wp-responsive-slider'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 500,
				],
				'range'   => [
					'px' => [
						'min'  => 100,
						'max'  => 5000,
						'step' => 50,
					],
				],
			]
		);

		$this->add_control(
			'coverflow_toggle',
			[
				'label'        => __('Coverflow Effect', 'wp-responsive-slider'),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'condition'    => [
					'skin' => 'coverflow'
				]
			]
		);

		$this->start_popover();

		$this->add_control(
			'coverflow_rotate',
			[
				'label'       => esc_html__('Rotate', 'wp-responsive-slider'),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size' => 50,
				],
				'range'       => [
					'px' => [
						'min'  => -360,
						'max'  => 360,
						'step' => 5,
					],
				],
				'condition'   => [
					'coverflow_toggle' => 'yes'
				],
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'coverflow_stretch',
			[
				'label'       => __('Stretch', 'wp-responsive-slider'),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size' => 0,
				],
				'range'       => [
					'px' => [
						'min'  => 0,
						'step' => 10,
						'max'  => 100,
					],
				],
				'condition'   => [
					'coverflow_toggle' => 'yes'
				],
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'coverflow_modifier',
			[
				'label'       => __('Modifier', 'wp-responsive-slider'),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size' => 1,
				],
				'range'       => [
					'px' => [
						'min'  => 1,
						'step' => 1,
						'max'  => 10,
					],
				],
				'condition'   => [
					'coverflow_toggle' => 'yes'
				],
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'coverflow_depth',
			[
				'label'       => __('Depth', 'wp-responsive-slider'),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size' => 100,
				],
				'range'       => [
					'px' => [
						'min'  => 0,
						'step' => 10,
						'max'  => 1000,
					],
				],
				'condition'   => [
					'coverflow_toggle' => 'yes'
				],
				'render_type' => 'template',
			]
		);

		$this->end_popover();

		$this->add_control(
			'hr_005',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'skin' => 'coverflow'
				]
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => __('Autoplay', 'wp-responsive-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__('Autoplay Speed', 'wp-responsive-slider'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'pauseonhover',
			[
				'label' => esc_html__('Pause on Hover', 'wp-responsive-slider'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'disableoninteraction',
			[
				'label' => esc_html__('Pause on Interaction', 'wp-responsive-slider'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'show_scrollbar',
			[
				'label' => esc_html__('Show Scrollbar', 'wp-responsive-slider'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'grab_cursor',
			[
				'label' => __('Grab Cursor', 'wp-responsive-slider'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => __('Loop', 'wp-responsive-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',

			]
		);

		$this->add_control(
			'observer',
			[
				'label'       => __('Observer', 'wp-responsive-slider'),
				'description' => __('When you use carousel in any hidden place (in tabs, accordion etc) keep it yes.', 'wp-responsive-slider'),
				'type'        => Controls_Manager::SWITCHER,
			]
		);
		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'type'           => Controls_Manager::SELECT,
				'label'          => esc_html__('Slides to Scroll', 'wp-responsive-slider'),
				'default'        => 1,
				'tablet_default' => 1,
				'mobile_default' => 1,
				'options'        => [
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
					5 => '5',
					6 => '6',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'      => __('Navigation', 'wp-responsive-slider'),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'navigation',
							'operator' => '!=',
							'value'    => 'none',
						],
						[
							'name'  => 'show_scrollbar',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'arrows_heading',
			[
				'label'     => __('A R R O W S', 'wp-responsive-slider'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->start_controls_tabs('tabs_navigation_arrows_style');

		$this->start_controls_tab(
			'tabs_nav_arrows_normal',
			[
				'label'     => __('Normal', 'wp-responsive-slider'),
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __('Color', 'wp-responsive-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .wprs-button-prev i, {{WRAPPER}} .wp-responsive-slider .wprs-button-next i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'arrows_background',
			[
				'label'     => __('Background', 'wp-responsive-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .wprs-button-prev, {{WRAPPER}} .wp-responsive-slider .wprs-button-next' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'nav_arrows_border',
				'selector'  => '{{WRAPPER}} .wp-responsive-slider .wprs-button-prev, {{WRAPPER}} .wp-responsive-slider .wprs-button-next',
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => __('Border Radius', 'wp-responsive-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .wp-responsive-slider .wprs-button-prev, {{WRAPPER}} .wp-responsive-slider .wprs-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label'      => esc_html__('Padding', 'wp-responsive-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .wp-responsive-slider .wprs-button-prev, {{WRAPPER}} .wp-responsive-slider .wprs-button-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_size',
			[
				'label'     => __('Size', 'wp-responsive-slider'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .wprs-button-prev i,
                {{WRAPPER}} .wp-responsive-slider .wprs-button-next i' => 'font-size: {{SIZE || 36}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_nav_arrows_hover',
			[
				'label'     => __('Hover', 'wp-responsive-slider'),
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'arrows_hover_color',
			[
				'label'     => __('Color', 'wp-responsive-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .wprs-button-prev:hover i, {{WRAPPER}} .wp-responsive-slider .wprs-button-next:hover i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'arrows_hover_background',
			[
				'label'     => __('Background', 'wp-responsive-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .wprs-button-prev:hover, {{WRAPPER}} .wp-responsive-slider .wprs-button-next:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'nav_arrows_hover_border_color',
			[
				'label'     => __('Border Color', 'wp-responsive-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .wprs-button-prev:hover, {{WRAPPER}} .wp-responsive-slider .wprs-button-next:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'nav_arrows_border_border!' => '',
					'navigation!'               => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'dots_heading',
			[
				'label'     => __('D O T S', 'wp-responsive-slider'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __('Color', 'wp-responsive-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'active_dot_color',
			[
				'label'     => __('Active Color', 'wp-responsive-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
				],
			]
		);

		$this->add_responsive_control(
			'dots_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'wp-responsive-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
				],
			]
		);

		$this->add_responsive_control(
			'dots_width_size',
			[
				'label'     => __('Width(px)', 'wp-responsive-slider'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
				],
			]
		);

		$this->add_responsive_control(
			'dots_height_size',
			[
				'label'     => __('Height(px)', 'wp-responsive-slider'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
				],
			]
		);

		$this->add_responsive_control(
			'dots_spacing',
			[
				'label'     => __('Spacing', 'wp-responsive-slider'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-pagination-bullet' => 'margin: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
				],
			]
		);


		$this->add_control(
			'fraction_heading',
			[
				'label'     => __('F R A C T I O N', 'wp-responsive-slider'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'hr_12',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'fraction_color',
			[
				'label'     => __('Color', 'wp-responsive-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-pagination-fraction' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'active_fraction_color',
			[
				'label'     => __('Active Color', 'wp-responsive-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-pagination-current' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'fraction_typography',
				'label'     => esc_html__('Typography', 'wp-responsive-slider'),
				'selector'  => '{{WRAPPER}} .wp-responsive-slider .swiper-pagination-fraction',
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'progresbar_heading',
			[
				'label'     => __('Progresbar', 'wp-responsive-slider'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'progresbar_color',
			[
				'label'     => __('Bar Color', 'wp-responsive-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-pagination-progressbar' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'progres_color',
			[
				'label'     => __('Progress Color', 'wp-responsive-slider'),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-pagination-progressbar .swiper-pagination-progressbar-fill' => 'background: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'hr_4',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_heading',
			[
				'label'     => __('Scrollbar', 'wp-responsive-slider'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_color',
			[
				'label'     => __('Bar Color', 'wp-responsive-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-scrollbar' => 'background: {{VALUE}}',
				],
				'condition' => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_drag_color',
			[
				'label'     => __('Drag Color', 'wp-responsive-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-scrollbar .swiper-scrollbar-drag' => 'background: {{VALUE}}',
				],
				'condition' => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'scrollbar_height',
			[
				'label'     => __('Height', 'wp-responsive-slider'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-container-horizontal > .swiper-scrollbar' => 'height: {{SIZE}}px;',
				],
				'condition' => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'navi_offset_heading',
			[
				'label' => __('Offset', 'wp-responsive-slider'),
				'type'  => Controls_Manager::HEADING,
				'conditions'     => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
					],
				],
			]
		);



		$this->add_responsive_control(
			'arrows_ncy_position',
			[
				'label'          => __('Arrows Vertical Offset', 'wp-responsive-slider'),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'size' => 40,
				],
				'tablet_default' => [
					'size' => 40,
				],
				'mobile_default' => [
					'size' => 40,
				],
				'range'          => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors'      => [
					'{{WRAPPER}}' => '--wp-responsive-slider-arrows-ncy: {{SIZE}}px;'
				],
				'conditions'     => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_acx_position',
			[
				'label'      => __('Arrows Horizontal Offset', 'wp-responsive-slider'),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 5,
				],
				'range'      => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wp-responsive-slider .wprs-button-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .wp-responsive-slider .wprs-button-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'dots_nnx_position',
			[
				'label'          => __('Dots Horizontal Offset', 'wp-responsive-slider'),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range'          => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'     => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'dots',
						],
						[
							'name'     => 'dots_position',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
				'selectors'      => [
					'{{WRAPPER}}' => '--wp-responsive-slider-dots-nnx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'dots_nny_position',
			[
				'label'          => __('Dots Vertical Offset', 'wp-responsive-slider'),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'size' => 30,
				],
				'tablet_default' => [
					'size' => 30,
				],
				'mobile_default' => [
					'size' => 30,
				],
				'range'          => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'     => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'dots',
						],
						[
							'name'     => 'dots_position',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
				'selectors'      => [
					'{{WRAPPER}}' => '--wp-responsive-slider-dots-nny: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'both_ncx_position',
			[
				'label'          => __('Arrows & Dots Horizontal Offset', 'wp-responsive-slider'),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range'          => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'     => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors'      => [
					'{{WRAPPER}}' => '--wp-responsive-slider-both-ncx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'both_ncy_position',
			[
				'label'          => __('Arrows & Dots Vertical Offset', 'wp-responsive-slider'),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'size' => 40,
				],
				'tablet_default' => [
					'size' => 40,
				],
				'mobile_default' => [
					'size' => 40,
				],
				'range'          => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'     => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors'      => [
					'{{WRAPPER}}' => '--wp-responsive-slider-both-ncy: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'both_cx_position',
			[
				'label'      => __('Arrows Offset', 'wp-responsive-slider'),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => -60,
				],
				'range'      => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wp-responsive-slider .wprs-button-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .wp-responsive-slider .wprs-button-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'  => 'both_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'both_cy_position',
			[
				'label'      => __('Dots Offset', 'wp-responsive-slider'),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 30,
				],
				'range'      => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wp-responsive-slider .wprs-dots-container' => 'transform: translateY({{SIZE}}px);',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'  => 'both_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_ncx_position',
			[
				'label'          => __('Arrows & Fraction Horizontal Offset', 'wp-responsive-slider'),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range'          => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'     => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'     => 'arrows_fraction_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors'      => [
					'{{WRAPPER}}' => '--wp-responsive-slider-arrows-fraction-ncx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_ncy_position',
			[
				'label'          => __('Arrows & Fraction Vertical Offset', 'wp-responsive-slider'),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'size' => 40,
				],
				'tablet_default' => [
					'size' => 40,
				],
				'mobile_default' => [
					'size' => 40,
				],
				'range'          => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'     => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'     => 'arrows_fraction_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors'      => [
					'{{WRAPPER}}' => '--wp-responsive-slider-arrows-fraction-ncy: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_cx_position',
			[
				'label'      => __('Arrows Offset', 'wp-responsive-slider'),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => -60,
				],
				'range'      => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wp-responsive-slider .wprs-button-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .wp-responsive-slider .wprs-button-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'  => 'arrows_fraction_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_cy_position',
			[
				'label'      => __('Fraction Offset', 'wp-responsive-slider'),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 30,
				],
				'range'      => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-pagination-fraction' => 'transform: translateY({{SIZE}}px);',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'  => 'arrows_fraction_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'progress_y_position',
			[
				'label'     => __('Progress Offset', 'wp-responsive-slider'),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 0,
				],
				'range'     => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-pagination-progressbar' => 'transform: translateY({{SIZE}}px);',
				],
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_responsive_control(
			'scrollbar_vertical_offset',
			[
				'label'     => __('Scrollbar Offset', 'wp-responsive-slider'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .wp-responsive-slider .swiper-container-horizontal > .swiper-scrollbar' => 'bottom: {{SIZE}}px;',
				],
				'condition' => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->end_controls_section();
	}
	function render_navigation() {
		$settings             = $this->get_settings_for_display();
		$hide_arrow_on_mobile = $settings['hide_arrow_on_mobile'] ? ' wprs-visible@m' : '';

		if ('arrows' == $settings['navigation']) : ?>
			<div class="wprs-position-z-index">
				<div class="wprs-arrows-container">
					<a href="" class="wprs-button-prev">
						<i class="eicon-angle-left"></i>
					</a>
					<a href="" class="wprs-button-next">
						<i class="eicon-angle-right"></i>
					</a>
				</div>
			</div>
		<?php endif;
	}

	function render_pagination() {
		$settings = $this->get_settings_for_display();

		if ('dots' == $settings['navigation'] or 'arrows-fraction' == $settings['navigation']) : ?>
			<div class="wprs-position-z-index wprs-position-bottom">
				<div class="wprs-dots-container">
					<div class="swiper-pagination"></div>
				</div>
			</div>

		<?php elseif ('progressbar' == $settings['navigation']) : ?>
			<div class="swiper-pagination wprs-position-z-index wprs-position-<?php echo esc_html($settings['progress_position']); ?>"></div>
		<?php endif;
	}

	function render_both_navigation() { ?>
		<div class="wprs-position-z-index wprs-position-bottom">
			<div class="wprs-arrows-dots-container wprs-slidenav-container ">
				<a href="" class="wprs-button-prev">
					<i class="eicon-angle-left"></i>
				</a>
				<a href="" class="wprs-button-next">
					<i class="eicon-angle-right"></i>
				</a>
			</div>
			<div class="wprs-dots-container">
				<div class="swiper-pagination"></div>
			</div>
		</div>
	<?php
	}

	function render_arrows_fraction() { ?>
		<div class="wprs-position-z-index wprs-position-bottom">
			<div class="wprs-arrows-fraction-container wprs-slidenav-container ">
				<a href="" class="wprs-button-prev">
					<i class="eicon-angle-left"></i>
				</a>
				<div class="swiper-pagination"></div>
				<a href="" class="wprs-button-next">
					<i class="eicon-angle-right"></i>
				</a>
			</div>
		</div>
	<?php
	}

	function render_footer() {
		$settings = $this->get_settings_for_display();

	?>
		<?php if ('yes' === $settings['show_scrollbar']) : ?>
			<div class="swiper-scrollbar"></div>
		<?php endif; ?>
		</div>

		<?php if ('both' == $settings['navigation']) : ?>
			<?php $this->render_both_navigation(); ?>
			<?php if ('center' === $settings['both_position']) : ?>
				<div class="wprs-position-z-index wprs-position-bottom">
					<div class="wprs-dots-container">
						<div class="swiper-pagination"></div>
					</div>
				</div>
			<?php endif; ?>
		<?php elseif ('arrows-fraction' == $settings['navigation']) : ?>
			<?php $this->render_arrows_fraction(); ?>
			<?php if ('center' === $settings['arrows_fraction_position']) : ?>
				<div class="wprs-dots-container">
					<div class="swiper-pagination"></div>
				</div>
			<?php endif; ?>
		<?php else : ?>
			<?php $this->render_pagination(); ?>
			<?php $this->render_navigation(); ?>
		<?php endif; ?>

		</div>
		</div>
	<?php
	}
	function render() {
		$settings = $this->get_settings_for_display();
		$id              = 'wp-responsive-slider-' . $this->get_id();
		$elementor_vp_lg = get_option('elementor_viewport_lg');
		$elementor_vp_md = get_option('elementor_viewport_md');
		$viewport_lg     = !empty($elementor_vp_lg) ? $elementor_vp_lg - 1 : 1023;
		$viewport_md     = !empty($elementor_vp_md) ? $elementor_vp_md - 1 : 767;

		if ('dots' == $settings['navigation']) {
			$this->add_render_attribute('responsive_slider', 'class', 'wprs-dots-align-' . $settings['dots_position']);
		} elseif ('both' == $settings['navigation']) {
			$this->add_render_attribute('responsive_slider', 'class', 'wprs-arrows-dots-align-' . $settings['both_position']);
		} elseif ('arrows-fraction' == $settings['navigation']) {
			$this->add_render_attribute('responsive_slider', 'class', 'wprs-arrows-dots-align-' . $settings['arrows_fraction_position']);
		}

		if ('arrows-fraction' == $settings['navigation']) {
			$pagination_type = 'fraction';
		} elseif ('both' == $settings['navigation'] or 'dots' == $settings['navigation']) {
			$pagination_type = 'bullets';
		} elseif ('progressbar' == $settings['navigation']) {
			$pagination_type = 'progressbar';
		} else {
			$pagination_type = '';
		}
		$this->add_render_attribute(
			'responsive_slider',
			[
				'class' => [
					'wp-responsive-slider'
				],
				'id' => $id,
				'data-settings' => [
					wp_json_encode(array_filter([
						"autoplay"              => ("yes" == $settings["autoplay"]) ? ["delay" => $settings["autoplay_speed"]] : false,
						"loop"                  => ($settings["loop"] == "yes") ? true : false,
						"speed"                 => $settings["speed"]["size"],
						"pauseOnHover"          => ("yes" == $settings["pauseonhover"]) ? true : false,
						"disableOnInteraction"          => ("yes" == $settings["disableoninteraction"]) ? true : false,
						"effect"                => $settings["transition"],
						"slidesPerView"         => (int) $settings["columns_mobile"],
						"breakpoints"           => [
							(int) $viewport_md => [
								"slidesPerView"  => (int) $settings["columns_tablet"],
								"spaceBetween"   => (int) $settings["item_gap_tablet"]["size"],
								"slidesPerGroup" => (int) $settings["slides_to_scroll_tablet"]
							],
							(int) $viewport_lg => [
								"slidesPerView"  => (int) $settings["columns"],
								"spaceBetween"   => (int) $settings["item_gap"]["size"],
								"slidesPerGroup" => (int) $settings["slides_to_scroll"]
							]
						],
						"navigation"            => [
							"nextEl" => "#" . $id . " .wprs-button-next",
							"prevEl" => "#" . $id . " .wprs-button-prev",
						],
						"pagination"            => [
							"el"             => "#" . $id . " .swiper-pagination",
							"type"           => $pagination_type,
							"clickable"      => "true",
							'dynamicBullets' => ("yes" == $settings["dynamic_bullets"]) ? true : false,
						],
						"scrollbar"             => [
							"el"   => "#" . $id . " .swiper-scrollbar",
							"hide" => "true",
						],
						'coverflowEffect'       => [
							'rotate'       => ("yes" == $settings["coverflow_toggle"]) ? $settings["coverflow_rotate"]["size"] : 50,
							'stretch'      => ("yes" == $settings["coverflow_toggle"]) ? $settings["coverflow_stretch"]["size"] : 0,
							'depth'        => ("yes" == $settings["coverflow_toggle"]) ? $settings["coverflow_depth"]["size"] : 100,
							'modifier'     => ("yes" == $settings["coverflow_toggle"]) ? $settings["coverflow_modifier"]["size"] : 1,
							'slideShadows' => true,
						]
					]))
				]
			]
		);

	?>


		<div <?php $this->print_render_attribute_string('responsive_slider'); ?>>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php foreach ($settings['slides_items'] as $key => $item) :
						$slide_image = Group_Control_Image_Size::get_attachment_image_src($item['slide_image']['id'], 'thumbnail_size', $settings);
						if (!$slide_image) :
							$slide_image = $item['slide_image']['url'];
						endif ?>
						<?php
						$this->add_render_attribute('slide-inner', [
							'class' => ['slide-inner'],
							'style' => [
								'background-color: ' . $item['image_background'] . ';',
								'background-size: ' . $item['image_size'] . ';',
								'background-position: ' . $item['image_horizontal_position'] . ' ' . $item['image_vertical_position'] . ' ;',
								'background-image:url(' . $slide_image . ');',
							]
						], null, true); ?>
						<div class="swiper-slide">
							<div <?php $this->print_render_attribute_string('slide-inner'); ?>>
							</div>
						</div>
					<?php endforeach ?>
				</div>
				<?php $this->render_footer(); ?>
			</div>
		</div>

<?php
	}
}
