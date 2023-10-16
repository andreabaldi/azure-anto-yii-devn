<?php

use kartik\growl\Growl;
use kartik\growl\Alert;

echo Growl::widget([
    'type' => Growl::TYPE_SUCCESS,
    'icon' => 'glyphicon glyphicon-ok-sign',
    'title' => 'User Info',
    'showSeparator' => true,
    'body' => 'This is a successful growling alert.',
    'pluginOptions' => [
        'placement' => [
            'showProgressbar' => true,
            'from' => 'bottom',
            'align' => 'center']],
]);


//
//echo Growl::widget([
//    'type' => Growl::TYPE_SUCCESS,
//    'title' => 'Well done!',
//    'icon' => 'fas fa-check-circle',
//    'body' => 'You successfully read this important alert message.',
//    'showSeparator' => true,
//    'delay' => 0,
//    'pluginOptions' => [
//        'showProgressbar' => true,
//        'placement' => [
//            'from' => 'top',
//            'align' => 'right',
//        ]
//    ]
//]);
//echo Growl::widget([
//    'type' => Growl::TYPE_INFO,
//    'title' => 'Heads up!',
//    'icon' => 'fas fa-info-circle',
//    'body' => 'This alert needs your attention, but it\'s not super important.',
//    'showSeparator' => true,
//    'delay' => 1500,
//    'pluginOptions' => [
//        'showProgressbar' => true,
//        'placement' => [
//            'from' => 'top',
//            'align' => 'right',
//        ]
//    ]
//]);
//echo Growl::widget([
//    'type' => Growl::TYPE_WARNING,
//    'title' => 'Warning!',
//    'icon' => 'fas fa-exclamation-circle',
//    'body' => 'Better check yourself, you\'re not looking too good.',
//    'showSeparator' => true,
//    'delay' => 3000,
//    'pluginOptions' => [
//        'showProgressbar' => true,
//        'placement' => [
//            'from' => 'top',
//            'align' => 'right',
//        ]
//    ]
//]);
//echo Growl::widget([
//    'type' => Growl::TYPE_DANGER,
//    'title' => 'Oh snap!',
//    'icon' => 'fas fa-times-circle',
//    'body' => 'Change a few things up and try submitting again.',
//    'showSeparator' => true,
//    'delay' => 4500,
//    'pluginOptions' => [
//        'showProgressbar' => true,
//        'placement' => [
//            'from' => 'top',
//            'align' => 'right',
//        ]
//    ]
//]);
//echo Growl::widget([
//    'type' => Growl::TYPE_GROWL,
//    'title' => 'Roar!',
//    'icon' => '/images/growl_64x.png',
//    'body' => 'This is a default growling alert you requested for.',
//    'showSeparator' => false,
//    'delay' => 6000,
//    'pluginOptions' => [
//        'icon_type'=>'image',
//        'showProgressbar' => false,
//        'placement' => [
//            'from' => 'top',
//            'align' => 'right',
//        ],
//    ]
//]);
//echo Growl::widget([
//    'type' => Growl::TYPE_MINIMALIST,
//    'title' => 'Kartik Visweswaran',
//    'icon' => '/images/kartik.png',
//    'iconOptions' => ['class'=>'img-circle pull-left'],
//    'body' => 'Momentum reduce child mortality effectiveness incubation empowerment connect.',
//    'showSeparator' => false,
//    'delay' => 7500,
//    'pluginOptions' => [
//        'icon_type'=>'image',
//        'showProgressbar' => false,
//        'placement' => [
//            'from' => 'top',
//            'align' => 'right',
//        ],
//    ]
//]);
//echo Growl::widget([
//    'type' => Growl::TYPE_PASTEL,
//    'title' => 'Email: Erica Fisher',
//    'icon' => '/images/growl_64x.png',
//    'body' => 'Investment, stakeholders micro-finance equity health Bloomberg; global citizens climate change. ' .
//        'Solve positive social change sanitation, opportunity insurmountable challenges...',
//    'showSeparator' => false,
//    'delay' => 9000,
//    'progressBarOptions' => ['class'=>'progress-bar-warning'],
//    'pluginOptions' => [
//        'showProgressbar' => true,
//        'icon_type'=>'image',
//        'placement' => [
//            'from' => 'top',
//            'align' => 'right',
//        ],
//    ]
//]);
?>