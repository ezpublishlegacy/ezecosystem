<?php
/**
 * @copyright Copyright (C) 1999-2013 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version  2013.5
 * @package kernel
 */

$OperationList = array();
// This operation is used when a user tries to add an object to the basket
// It will be called from content/add
$OperationList['addtobasket'] = array( 'name' => 'addtobasket',
                                       'default_call_method' => array( 'include_file' => 'kernel/shop/ezshopoperationcollection.php',
                                                                       'class' => 'eZShopOperationCollection' ),
                                       'parameter_type' => 'standard',
                                       'parameters' => array( array( 'name' => 'object_id',
                                                                     'type' => 'integer',
                                                                     'required' => true ),
                                                              array( 'name' => 'option_list',
                                                                     'type' => 'array',
                                                                     'required' => true ),
                                                              array( 'name' => 'quantity',
                                                                     'type' => 'integer',
                                                                     'required' => false ),
                                                              array( 'name' => 'basket_id',
                                                                     'type' => 'integer',
                                                                     'required' => true ) ),
                                       'keys' => array( 'basket_id', 'object_id' ),
                                       'body' => array( array( 'type' => 'trigger',
                                                               'name' => 'pre_addtobasket',
                                                               'keys' => array( 'object_id' ) ),
                                                        array( 'type' => 'method',
                                                               'name' => 'add-to-basket',
                                                               'frequency' => 'once',
                                                               'method' => 'addToBasket' ),
                                                        array( 'type' => 'method',
                                                               'name' => 'update-shipping-info',
                                                               'frequency' => 'once',
                                                               'method' => 'updateShippingInfo' ),
                                                        array( 'type' => 'trigger',
                                                               'name' => 'post_addtobasket',
                                                               'keys' => array( 'object_id' ) ) ) );

$OperationList['confirmorder'] = array( 'name' => 'confirmorder',
                                        'default_call_method' => array( 'include_file' => 'kernel/shop/ezshopoperationcollection.php',
                                                                        'class' => 'eZShopOperationCollection' ),
                                        'parameter_type' => 'standard',
                                        'parameters' => array( array( 'name' => 'order_id',
                                                                      'type' => 'integer',
                                                                      'required' => true ) ),
                                        'keys' => array( 'order_id' ),
                                        'body' => array( array( 'type' => 'trigger',
                                                                'name' => 'pre_confirmorder',
                                                                'keys' => array( 'order_id' ) ),
                                                         array( 'type' => 'method',
                                                                'name' => 'handle-user-country',
                                                                'frequency' => 'once',
                                                                'method' => 'handleUserCountry' ),
                                                         array( 'type' => 'method',
                                                                'name' => 'handle-shipping',
                                                                'frequency' => 'once',
                                                                'method' => 'handleShipping' ),
                                                         array( 'type' => 'method',
                                                                'name' => 'fetch-order',
                                                                'frequency' => 'once',
                                                                'method' => 'fetchOrder' ) ) );

$OperationList['updatebasket'] = array( 'name' => 'updatebasket',
                                        'default_call_method' => array( 'include_file' => 'kernel/shop/ezshopoperationcollection.php',
                                                                        'class' => 'eZShopOperationCollection' ),
                                        'parameter_type' => 'standard',
                                        'parameters' => array( array( 'name' => 'item_count_list',
                                                                      'type' => 'array',
                                                                      'required' => true ),
                                                               array( 'name' => 'item_id_list',
                                                                      'type' => 'array',
                                                                      'required' => true )
                                                              ),
                                        'keys' => array( 'item_count_list', 'item_id_list' ),
                                        'body' => array( array( 'type' => 'trigger',
                                                                'name' => 'pre_updatebasket',
                                                                'keys' => array(  ) ),
                                                         array( 'type' => 'method',
                                                                'name' => 'update-basket',
                                                                'frequency' => 'once',
                                                                'method' => 'updateBasket' ),
                                                         array( 'type' => 'trigger',
                                                                'name' => 'post_updatebasket',
                                                                'keys' => array(  ) ),
                                                        ) );

$OperationList['checkout'] = array( 'name' => 'checkout',
                                    'default_call_method' => array( 'include_file' => 'kernel/shop/ezshopoperationcollection.php',
                                                                    'class' => 'eZShopOperationCollection' ),
                                    'parameter_type' => 'standard',
                                    'parameters' => array( array( 'name' => 'order_id',
                                                                  'type' => 'integer',
                                                                  'required' => true ) ),
                                    'keys' => array( 'order_id' ),
                                    'body' => array( array( 'type' => 'method',
                                                            'name' => 'check-currency',
                                                            'frequency' => 'once',
                                                            'method' => 'checkCurrency' ),
                                                     array( 'type' => 'trigger',
                                                            'name' => 'pre_checkout',
                                                            'keys' => array( 'order_id' ) ),
                                                     array( 'type' => 'method',
                                                            'name' => 'activate-order',
                                                            'frequency' => 'once',
                                                            'method' => 'activateOrder' ),
                                                     array( 'type' => 'method',
                                                            'name' => 'send-order-email',
                                                            'frequency' => 'once',
                                                            'method' => 'sendOrderEmails' ),
                                                     array( 'type' => 'trigger',
                                                            'name' => 'post_checkout',
                                                            'keys' => array( 'order_id' ) ) ) );
?>
