<?php
return 
array (
  'delivery_boy_messages' => [
    'new_order' => 'You have the new order assigned',
    'new' => 'Send message',
    'f_created_at' => 'Sent at',
    'f_read' => 'Read',
    'f_message' => 'Text'
  ],
  'order_statuses' => [
    'f_available_to_delivery_boy' => 'Can be set by delivery boy',
    'menu_title' => 'Order Statuses',
    'new' => 'Create order status',
    'f_name' => 'Title',
    'f_sort' => 'Sort Order',
    'f_is_default' => 'Is default'
  ],
  'promo_codes' => 
  array (
    'menu_title' => 'Promo codes',
    'f_name' => 'Name',
    'f_code' => 'Code',
    'f_discount' => 'Discount',
    'f_discount_in_percent' => 'Discount in percents',
    'f_limit' => 'Limit use count',
    'f_used' => 'Use count',
    'f_min_price' => 'Min order',
    'f_active_from' => 'Active from',
    'f_active_to' => 'Active to',
    'new' => 'Add Promo Code',
    'f_city' => 'City',
    'f_restaurant' => 'Restaurant',
  ),
  'delivery_areas' => 
  array (
    'menu_title' => 'Delivery Areas',
    'new' => 'Add delivery area',
    'f_name' => 'Area name',
    'f_price' => 'Delivery price',
    'f_city' => 'City',
  ),
  'categories' => 
  array (
    'menu_title' => 'Categories',
    'new' => 'Add category',
    'f_name' => 'Name',
    'f_parent' => 'Parent Category',
    'f_image' => 'Image',
    'f_city' => 'City',
    'f_restaurant' => 'Restaurant',
  ),
  'products' => 
  array (
    'new' => 'Add product',
    'sort' => 'Sort order',
    'bulk_upload' => 'Bulk upload',
    'menu_title' => 'Products',
    'f_name' => 'Name',
    'f_category' => 'Category',
    'f_vendor' => 'Vendor',
    'f_price' => 'Price',
    'f_price_old' => 'Old Price',
    'f_image' => 'Image',
    'f_description' => 'Description',
    'add_image' => 'Add image',
    'add_images' => 'Upload more images',
    'filter_text' => 'Find by',
    'f_tax_group' => 'Tax Group',
    'f_city' => 'City',
    'f_restaurant' => 'Restaurant',
    'imported' => 'Import done, :created products created, :updated products updated',
    'bulk_file' => 'File to import',
  ),
  'orders' => 
  array (
    'f_status' => 'Status',
    'delivery_boy' => 'Delivery boy',
    'index_title' => 'Orders',
    'menu_title' => 'Orders',
    'new' => 'Create order',
    'f_created' => 'Date and Time',
    'd_promo_discount' => 'Promo Code Discount:',
    'f_area' => 'Delivery Area',
    'f_name' => 'Name',
    'f_address' => 'Address',
    'f_phone' => 'Phone',
    'f_sum' => 'Total sum',
    'f_promo_code' => 'Promo code used',
    'f_is_paid' => 'Is paid',
    'f_payment_method' => 'Payment method',
    'show_title' => 'Order #:id',
    'total_title' => 'Total:',
    'delivery_title' => 'Delivery:',
    'grand_total_title' => 'Grand Total:',
    'd_comment' => 'Client Comment:',
    'd_client_name' => 'Client Name: ',
    'd_address' => 'Delivery Address: ',
    'd_area' => 'Delivery Area: ',
    'd_phone' => 'Phone Number: ',
    'filter_text' => 'Search by',
    'id' => '#',
    'payment_methods' => 
    array (
      'cash' => 'Cash on delivery',
      'stripe' => 'Stripe',
      'paypal' => 'PayPal',
    ),
    'f_tax' => 'Tax',
    'f_total_with_tax' => 'Total with tax',
    'f_city' => 'City',
    'f_restaurant' => 'Restaurant',
    'tax_title' => 'Tax',
    'total_with_tax_title' => 'Total with tax',
    'products_title' => 'Products for order #:id',
  ),
  'push_messages' => 
  array (
    'menu_title' => 'Push Messages',
    'f_message' => 'Message Text',
    'f_created_at' => 'Sent on',
    'f_status' => 'Status',
    'new' => 'Send message',
    'status' => 
    array (
      0 => 'Created',
      1 => 'Sent',
      2 => 'Error',
      3 => 'No ID or Key',
    ),
  ),
  'ordered_products' => 
  array (
    'f_name' => 'Product',
    'f_price' => 'Price',
    'f_count' => 'Quantity',
    'f_total' => 'Total',
    'new' => 'Add product to order',
  ),
  'settings' => 
  array (
      'loyalty' => 'Loyalty program',
    'payment' => 'Payment',
    'layout' => 'Layout',
    'f_product_layout' => 'Products list',
    'f_category_layout' => 'Categories list',
    'product_layout_1' => 'List',
    'product_layout_2' => 'Picture on left',
    'product_layout_3' => 'Two columns',
    'category_layout_1' => 'List',
    'category_layout_2' => 'Two columns',
    'menu_title' => 'Settings',
    'f_loyalty_points_per_amount' => 'Add loyalty points for each X dollars(our your other currency) spent',
    'f_loyalty_points_per_order' => 'Loyalty points achieved per amount above',
    'f_loyalty_points_for_reward' => 'Loyalty points required for reward',
    'f_loyalty_reward_amount' => 'Loyalty reward amount',
    'f_driver_onesignal_token' => 'OneSignal Auth Token for Drivers App',
    'f_driver_onesignal_id' => 'OneSignal App ID for Drivers App',
    'f_date_format_app' => 'Date format for mobile app',
    'f_date_format' => 'Date format for backoffice',
    'f_delivery_price' => 'Delivery price',
    'f_time_format_backend' => 'Time format for backoffice',
    'f_time_format_app' => 'Time format for mobile app',
    'f_currency_format' => 'Currency format',
    'f_pushwoosh_id' => 'OneSignal App ID',
    'f_pushwoosh_token' => 'OneSignal Auth Token',
    'f_gcm_project_id' => 'GCM Project ID',
    'f_notification_email' => 'Notification Email',
    'f_stripe_publishable' => 'Stripe Publishable Key',
    'f_stripe_private' => 'Stripe Secret Key',
    'f_paypal_client_id' => 'PayPal Client ID',
    'f_paypal_client_secret' => 'PayPal Client Secret',
    'f_paypal_currency' => 'PayPal Currency',
    'notifications' => 'Notifications',
    'multi_location' => 'Multiple Restaurants and/or Locations',
    'general' => 'General',
    'stripe' => 'Stripe',
    'paypal' => 'PayPal',
    'push' => 'Push Messages',
    'f_mail_from_new_order_subject' => 'New Order Mail Subject',
    'f_mail_from_name' => 'Notification Mail From',
    'f_mail_from_mail' => 'Notification Mail From Address',
    'f_tax_included' => 'Tax is included to price',
    'f_multiple_restaurants' => 'Enable multiple restaurants',
    'f_multiple_cities' => 'Enable multiple cities',
    'f_signup_required' => 'Require client signup',
    'f_paypal_production' => 'PayPal Production mode'
  ),
  'news' => 
  array (
    'menu_title' => 'News Feed',
    'f_title' => 'Title',
    'f_announce' => 'Announce',
    'f_full_text' => 'Full Text',
    'f_image' => 'Banner Image',
    'filter_text' => 'Filter',
    'new' => 'Add News Item',
  ),
  'actions' => 
  array (
    'save' => 'Save',
    'edit' => 'Edit',
    'delete' => 'Delete',
    'show' => 'Show Details',
    'filter' => 'Filter',
    'clear_filter' => 'Clear Filter',
    'edit_products' => 'Products List',
  ),
  'common' => 
  array (
    'yes' => 'Yes',
    'no' => 'No',
    'confirm' => 'Are you sure?',
  ),
  'tax_groups' => 
  array (
    'menu_title' => 'Tax Groups',
    'new' => 'Add Tax Group',
    'f_name' => 'Group name',
    'f_value' => 'Tax Value (%)',
    'f_is_default' => 'Default Tax',
  ),
  'cities' => 
  array (
    'menu_title' => 'Cities',
    'f_name' => 'Name',
    'f_sort' => 'Sort order',
    'new' => 'Add City',
  ),
  'restaurants' => 
  array (
    'menu_title' => 'Restaurants',
    'f_name' => 'Name',
    'f_sort' => 'Sort order',
    'f_image' => 'Logo',
    'f_city' => 'City',
    'new' => 'Add Restaurant',
    'filter_text' => 'Search',
  ),
  'dashboard' => 
  array (
    'today' => 'Today',
    'yesterday' => 'Yesterday',
    'this_month' => 'This month',
    'last_month' => 'Last month',
    'menu_title' => 'Dashboard',
    'sales' => 'Total sales',
    'bills' => 'Total bills',
    'users' => 'New customers',
    'title' => 'Dashboard',
    'sales_int' => 'Sales',
  ),
  'homepage' =>
  array (
    'title' => 'Title',
    'menu_title' => 'Homepage',
    'description' => 'Description',
  ),
  'customers' => 
  array (
    'menu_title' => 'Customers',
    'filter_text' => 'Search',
    'orders_list' => 'Orders history',
    'f_loyalty_reward' => 'Loyalty reward',
    'f_loyalty_points' => 'Loyalty points',
    'f_name' => 'Name',
    'f_phone' => 'Mobile',
    'f_email' => 'Email',
    'f_password' => 'Password',
    'f_city' => 'City',
    'f_orders_count' => 'Orders count',
    'f_orders_sum' => 'Orders total',
  ),
  'users' => 
  array (
    'menu_title' => 'Users',
    'f_name' => 'Name',
    'f_email' => 'Email',
    'f_city' => 'City',
    'f_password' => 'Password',
    'f_password_confirmation' => 'Password confirmation',
    'filter_text' => 'Search',
    'f_cities' => 'Cities',
    'new' => 'Add user',
    'access_to_cities' => 'Access to cities',
    'access_to_system_parts' => 'Access to system parts',
    'access_news' => 'News',
    'access_categories' => 'Categories',
    'access_products' => 'Products',
    'access_orders' => 'Orders',
    'access_customers' => 'Customers',
    'access_pushes' => 'Push messages',
    'access_delivery_areas' => 'Delivery areas',
    'access_promo_codes' => 'Promo codes',
    'access_tax_groups' => 'Tax groups',
    'access_cities' => 'Cities',
    'access_restaurants' => 'Restaurants',
    'access_settings' => 'Settings',
    'access_users' => 'Users',
    'access_full' => 'FULL access',
    'access_delivery_boys' => 'Delivery boys',
    'access_order_statuses' => 'Order statuses',
    'access_vendors' => 'Vendors',
    'access_homepage' => 'Homepage'
  ),
  'delivery_boys' => 
  array (
    'messages' => 'Messages',
    'new' => 'Add delivery boy',
    'f_name' => 'Name',
    'f_login' => 'Login',
    'f_password' => 'Password',
    'f_password_confirmation' => 'Password confirmation',
    'menu_title' => 'Delivery Boys',
    'f_orders_count' => 'Orders count',
  ),
    'vendors' => [
        'menu_title' => 'Vendors',
        'new' => 'Add vendor',
        'f_name' => 'Name',
        'f_sort' => 'Sort order',
        'f_image' => 'Image'
    ]
)
;