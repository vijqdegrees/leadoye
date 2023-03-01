<?php
return array_merge(
    [
        'lang' => 'English',
        'lang_short' => 'EN',
        // Responses
        'created_response' => ':name has been created successfully',
        'updated_response' => ':name has been updated successfully',
        'deleted_response' => ':name has been deleted successfully',
        'failed_response' => 'Something went wrong',
        'notified' => ':name has been notified successfully',
        'duplicated_response' => ':name has been duplicated successfully',
        'status_updated_response' => ':name status has been changed to :status',
        'action_not_allowed' => 'You are not allowed for this action',
        'cant_delete_own_account' => 'You can\'t delete your own account',
        'attached_response' => ':name has been attached successfully',
        'detached_response' => ':name has been detached successfully',
        'default_delete' => 'You can not delete the default :name .',
        'default_update' => 'You can not update the default :name',
        'old_password_is_in_correct' => 'Old password is incorrect',
        'attach_log' => 'New :pivot attached to :model',
        'detach_log' => ':pivot detached from :model',
        'status_log' => ':model has been :status',
        'incorrect_user_password' => 'Incorrect user or password',
        'invite_user_response' => 'User has been invited successfully',
        'invalid_token' => 'The token is Invalid',
        'user_account_confirmed' => 'Your account has been confirmed successfully',
        'user_invited_to_join' => 'An user has been invited to join',
        'user_confirm_joining' => 'User confirmed his joining',
        'log_description_message' => ':model has been :event',
        'password_reset_mail_has_been_sent_successfully' => 'We sent an email containing password reset link to your email address. Please check it',
        'no_user_found_on_that_email' => 'No user found of that email address.',
        'password_has_been_reset_successfully' => 'Your password has been reset successfully',
        'resource_not_found' => 'The :resource you are looking for is not found.',
        'created' => 'created',
        'deleted' => 'deleted',
        'updated' => 'updated',
        'resource' => 'resource',

        // HTTP Responses
        '0' => 'ZERO (0)',
        '200' => 'Success',
        '2' => 'TWO (2)',
        '400' => 'Bad Request',
        '401' => 'Unauthorized',
        '403' => 'Forbidden',
        '404' => 'Not Found',
        '413' => 'Payload too large',
        '414' => 'URI Too long',
        '415' => 'Unsupported Media Type',
        '426' => 'Upgrade Required',
        '429' => 'Too Many Requests',

        // Features

        // Custom Field Builder
        'custom_field' => 'Custom field',
        'custom_field_type' => 'Custom field Type',

        // Fields
        'text' => 'Textbox',
        'textarea' => 'Textarea',
        'checkbox' => 'Checkbox',
        'radio_button' => 'Radio Button',
        'select' => 'Select',
        'multi_select' => 'Multi Select',
        'did_not_match_anything' => "Didn't match anything",
        'enter_to_add_new' => 'Enter to add new',
        'no_options_found' => 'No options found',
        'pick_a_color' => 'Pick a color',

        // Notification event
        'notification_event_name' => ':name :action',
        'notification_created' => 'created',
        'notification_updated' => 'updated',
        'notification_deleted' => 'deleted',
        'notification_user' => 'user',
        'notification_reset' => 'reset',
        'notification_invited' => 'invited',

        // Notification event name

        'user_invitation' => 'User Invitation',
        'user_joined' => 'User Joined',
        'pipeline_created' => 'Pipeline Created',
        'pipeline_updated' => 'Pipeline Updated',
        'pipeline_deleted' => 'Pipeline Deleted',
        'deal_created' => 'Deal Created',
        'deal_updated' => 'Deal Updated',
        'deal_deleted' => 'Deal Deleted',
        'deal_assigned' => 'Deal Assigned',
        // Notifications
        'notification' => 'Notification',
        'notify_by_email' => 'Notify by Email',
        'notify_by_sms' => 'Notify by SMS',
        'notification_settings' => 'Notification settings',
        'notification_template' => 'Notification template',

        // Labels
        'user' => 'User',
        'brand' => 'Brand',
        'status' => 'Status',
        'name' => 'Name',
        'mail' => 'Mail',
        'value' => 'Value',
        'type' => 'Type',
        'database' => 'System',
        'sms' => 'SMS',
        'users' => 'Users',
        'roles' => 'Roles',
        'role' => 'Role',
        'no_roles_found' => 'No roles found for this user',
        'permissions' => 'Permissions',
        'permission' => 'Permission',
        'settings' => 'Settings',
        'password' => 'Password',
        'show_password' => 'Show password',
        'hide_password' => 'Hide password',
        'allowed' => 'allowed',
        'profile_picture' => 'Profile picture',
        'delivery_settings' => 'Delivery settings',
        'brand_settings' => 'Brand settings',
        'privacy_settings' => 'Privacy settings',
        'corn_job' => 'Corn job',
        'brand_group' => 'Brand group',
        'template' => 'Template',
        'profile' => 'Profile',
        'log' => 'Log',
        'invite' => 'Invite',
        'accepted' => 'Accepted',
        'schedule' => 'Schedule',
        'include_custom_fields' => 'Include custom fields',
        'default_fields_only' => 'Default fields only',
        'custom_fields_also' => 'Custom fields only',
        'choice_your_activity_type' => 'Choice your activity type',

        //Settings
        'app_name' => 'App Name',
        'brand_name' => 'Brand Name',

        // Status
        'status_active' => 'Active',
        'status_pending' => 'Pending',
        'status_deleted' => 'Deleted',
        'status_processing' => 'Processing',
        'status_sent' => 'Sent',
        'status_draft' => 'Draft',
        'status_regular' => 'Regular',
        'status_auto' => 'Auto',
        'status_dynamic' => 'Dynamic',
        'status_imported' => 'Imported',
        'status_black-listed' => 'Black listed',
        'status_inactive' => 'Inactive',

        // Permissions
        'manage_dashboard' => 'Can see the app dashboard.',
        'view_users' => 'Can view list of user',
        'create_users' => 'Can create a user',
        'update_users' => 'Can update a user',
        'delete_users' => 'Can delete a user',
        'view_brands' => 'Can view list of brand',
        'create_brands' => 'Can create brand',
        'update_brands' => 'Can update brand',
        'delete_brands' => 'Can delete brand',
        'user_list_brands' => 'Can view users of a brand',
        'attach_users_brands' => 'Can attach user to brand',
        'detach_users_brands' => 'Can detach user from a brand',
        'brand_list_users' => 'Can view brands of a user',
        'manage_brand_dashboard' => 'Can view brand dashboard',
        'update_brand_privacy_settings' => 'Can update brand privacy from app',
        'view_brand_privacy_settings' => 'Can view brand privacy from app',
        'view_roles' => 'Can view list of role',
        'create_roles' => 'Can create role',
        'update_roles' => 'Can update role',
        'delete_roles' => 'Can delete role',
        'view_settings' => 'Can view general settings',
        'update_settings' => 'Can update general settings',
        'view_permission' => 'Can view list of permission',
        'view_custom_fields' => 'Can view list of custom field',
        'create_custom_fields' => 'Can create custom field',
        'update_custom_fields' => 'Can update custom field',
        'delete_custom_fields' => 'Can delete custom field',
        'attach_roles_users' => 'Can attach roles to users',
        'detach_roles_users' => 'Can detach roles from users',
        'attach_permissions_roles' => 'Can attach permissions to role',
        'detach_permissions_roles' => 'Can detach permissions from role',
        'change_settings_users' => 'Can change own settings',
        'settings_list_users' => 'Can view settings list',
        'change_password_users' => 'Can change user password',
        'change_profile_picture_users' => 'Can change profile picture',
        'update_delivery_settings' => 'Can update email settings',
        'update_corn_job_settings' => 'Can update corn job settings',
        'view_corn_job_settings' => 'Can view corn job settings',
        'view_delivery_settings' => 'Can view email settings',
        'view_brand_delivery_settings' => 'Can view brand delivery settings',
        'view_notification_settings' => 'Can view notification settings',
        'update_notification_settings' => 'Can update notification settings',
        'create_brand_groups' => 'Can create brand group',
        'view_brand_groups' => 'Can view brand group',
        'update_brand_groups' => 'Can update brand group',
        'delete_brand_groups' => 'Can delete brand group',
        'attach_brand_brand_groups' => 'Can attach brand to brand group',
        'detach_brand_brand_groups' => 'Can detach brand from brand group',
        'view_brands_brand_groups' => 'Can view brands of a brand group',
        'view_notification_templates' => 'Can view notification templates',
        'create_notification_templates' => 'Can create notification templates',
        'update_notification_templates' => 'Can update notification templates',
        'delete_notification_templates' => 'Can delete notification templates',
        'attach_templates_notification_events' => 'Can attach templates to notification event',
        'detach_templates_notification_events' => 'Can detach templates to notification event',
        'view_activity_logs' => 'Can view activity log',
        'view_templates' => 'Can view templates',
        'create_templates' => 'Can create templates',
        'update_templates' => 'Can update templates',
        'delete_templates' => 'Can delete templates',
        'invite_user' => 'Can invite user',

        'date_format' => 'date format',
        'time_format' => 'time format',
        'decimal_separator' => 'Decimal separator',
        'thousand_separator' => 'Thousand separator',
        'number_of_decimal' => 'Number of decimal',
        'currency_position' => 'Currency position',

        //Update
        'You are using version' => 'You are using :version.',
        'no_new_update_found' => 'No new update found.',

        // Language
        'en' => 'English',

        // Date Format
        'd-m-Y' => 'DD-MM-YYYY',
        'm-d-Y' => 'MM-DD-YYYY',
        'Y-m-d' => 'YYYY-MM-DD',
        'm/d/Y' => 'MM/DD/YYYY',
        'd/m/Y' => 'DD/MM/YYYY',
        'Y/m/d' => 'YYYY/MM/DD',
        'm.d.Y' => 'MM.DD.YYYY',
        'd.m.Y' => 'DD.MM.YYYY',
        'Y.m.d' => 'YYYY.MM.DD',
        'dd-mm-yyyy' => 'DD-MM-YYYY',

        // Time Format
        'h' => '12 HOURS',
        'H' => '24 HOURS',

        // Decimal and Thousand Separator
        '.' => 'DOT(.)',
        ',' => 'COMMA(,)',
        'space' => 'SPACE',

        // Currency Positions
        'prefix_only' => '$1,100.00',
        'prefix_with_space' => '$ 1,100.00',
        'suffix_only' => '1,100.00$',
        'suffix_with_space' => '1,100.00 $',

        // Validation
        'is_required' => 'is required',
        'and' => 'and',
        'this_field_is_required' => 'This field is required',
        'this_field_is_invalid' => 'This field is invalid',
        'this_field_is_not_alphanumeric' => 'This field is not alphanumeric',
        'passwords_are_not_matched' => 'Passwords are not matched',
        'please_enter_a_strong_password' => 'Please enter a strong password.',
        'are_not_match' => 'are not match',
        'can_not_before' => 'can not before',
        'is_invalid' => 'is invalid',
        'minimum_length_is' => 'Minimum length is',
        'maximum_length_is' => 'Maximum length is',
        'maximum_number_is' => 'Maximum number is',
        'minimum_number_is' => 'Minimum number is',
        'is_not_alphanumeric' => 'is not alphanumeric',
        'not_found' => 'Not found',

        // Btn
        'load_more' => 'Load more',
        'apply' => 'Apply',
        'clear' => 'Clear',
        'close' => 'Close',
        'yes' => 'Yes',
        'no' => 'No',
        'more' => 'more',
        'actions' => 'Actions',

        // Multi select component
        'add' => 'add',

        // Datatable
        'items_showing_per_page' => 'Items showing per page',
        'items_selected' => 'items selected',
        'select_all' => 'Select all',
        'clear_selection' => 'Clear selection',
        'showing' => 'Showing',
        'to' => 'to',
        'items' => 'items',
        'of' => 'of',
        'go_to_page' => 'Go to page',
        'loading' => 'Loading',
        'next_five_pages' => 'Next 5 pages',
        'previous_five_pages' => 'Previous 5 pages',
        'click_to_highlights' => 'Click to highlights',

        // Filters
        'filters' => 'Filters',
        'minimum_rate' => 'Minimum rate',
        'maximum_rate' => 'Maximum rate',
        'want_to_manage_datatable' => 'Want to manage datatable?',
        'please_drag_and_drop_your_column_to_reorder_your_table_and_enable_see_option_as_you_want' => 'Please drag and drop your column to reorder your table and enable see option as you want.',
        'manage_columns' => 'Manage Columns',
        'search' => 'Search',
        'today' => 'Today',
        'date' => 'Date',
        'select_an_option' => 'Select an option',
        'clear_all_filters' => 'Clear all filters',
        'sort_by' => 'Sort by',
        'saved_filter' => 'Saved filter',
        'filter_name' => 'Filter name',
        'save_current_filter_state' => 'Save current filter state',
        'select_form_previous_state' => 'Choose from previous filter state',
        'at_least_one_filter_should_have_selected' => 'At least one filter should have selected',
        'filter_saved_instruction' => 'You can choose from your previous saved filter. Or you can save current filter state for future.',

        // Modal
        'are_you_sure' => 'Are you sure?',
        'this_content_will_be_deleted_permanently' => 'This content will be deleted permanently.',

        // Empty data
        'nothing_to_show_here' => 'Nothing to show here',
        'thank_you' => 'Thank you',
        'go_back_to_your_page' => 'Go back to your page',
        'something_went_wrong' => 'Something went wrong!',
        'empty_data_block_dummy_message' => 'Please add a new entity or manage the data table to see the content here',

        // File upload
        'change_image' => 'Change Image',
        'choose_file' => 'Choose File',
        'drag_and_drop' => 'Drag & Drop',
        'or' => 'or',
        'browse' => 'Browse',

        // No notification
        'no_notification_one' => "It's very much boring to do as usual stuff, let's have a party with some beer!",
        'no_notification_two' => 'Are you hungry there? Please have good food and get back to work.',
        'no_notification_three' => 'Rock & role time! Turn on your music and have some fun with your team.',
        'all_notifications' => 'All Notifications',

        // Tooltip titles
        'collapse_sidebar' => 'Collapse sidebar',
        'floating_sidebar' => 'Floating sidebar',
        'full_sidebar' => 'Full sidebar',
        'light_mood' => 'Light mood',
        'dark_mood' => 'Dark mood',
        'fullscreen' => 'Fullscreen',
        'exit_fullscreen' => 'Exit fullscreen',

        // Tenant Preview Card
        'invited_by' => 'Invited by',
        'short_name' => 'Short name',
        'group' => 'Group',
        'go_to_dashboard' => 'Go To Dashboard',
        'install' => 'Install',
        'password_requirements' => 'Password requirements.',
        'password_requirements_message' => 'The password should contain one upper case, one lower case, one special character, and numbers. It should be a minimum of 8 characters.',
        'database_configuration' => 'Database configuration',
        'db_connection' => 'Database connection',
        'database_hostname' => 'Database host',
        'database_port' => 'Database port',
        'database_name' => 'Database name',
        'database_username' => 'Database username',
        'database_password' => 'Database password',
        'admin_login_details' => 'Admin Login Details',
        'purchase_code' => 'Purchase code',
        'code' => 'Code',
        'mysql' => 'MySQL 5.6+',
        'pgsql' => 'PostgreSQL 9.4+',
        'sqlsrv' => 'SQL Server 2017+',
        'invalid_purchase_code' => 'Invalid purchase code',
        'app_installed_successfully' => 'App installed successfully',
        'save_&_next' => 'Save & next',
        'database_credential_error' => 'Incorrect database credentials',
        'environment_setup_successfully' => 'Environment setup successfully',
        'csrf_token_mismatch_message' => 'Maybe you are in a frame. Please remove the frame and try again.',
        'user_invitation_canceled_successfully' => 'User invitation canceled successfully.',

        // Time - picker input
        'am' => 'AM',
        'pm' => 'PM',
        'no_open_deal' => 'There is no open deal',
        'please_select_a_deal' => 'Please select a deal',
        'Call' => 'Call',
        'Meeting' => 'Meeting',
        'Deadline' => 'Deadline',



        'total_todo_activity' => 'Total todo activity',
        'total_done_activity' => 'Total done activity',
        'total_proposal' => 'Total proposal',
        'comments' => 'Comments',
        'send_proposal_with_new_template' => 'With new template',
        'send_quick_proposal' => 'Or want to send a quick proposal',
        'or_delete_anyway'=>'Or delete anyway',
        'move_to_another_stage' => 'Want to move these deals to another stage?',
        'do_you_want_to_see_done_activity' => 'Do you want to see done activity?',
        'show_done_activity' => 'Show done activity',
        'leads' => 'Leads',
        'persons' => 'Persons',

        //activity option
        'call' => 'Call',
        'email' => 'Email',
        'meeting' => 'Meeting',
        'task' => 'Task',
        'others' => 'Others',
        'deadline' =>'Deadline',

        'any' => 'Any',
        'users_and_roles' => 'Users and Roles',
        'import' => 'Import',
        'import_persons' => 'Import persons',

        // Email
        'inbox' => 'Inbox',
        'email_compose' => 'Email compose',
        'compose_mail' => 'Compose mail',
        'sent_emails' => 'Sent Emails',
        'favourite' => 'Favourite',
        'draft' => 'Draft',
        'deleted' => 'Deleted',
        'more' => 'More',
        'labels' => 'Labels',
        'promising_offers' => 'Promising offers',
        'work_in_progress' => 'Work in Progress',
        'support' => 'Support',
        'promotions' => 'Promotions',
        'read_later' => 'Read later',
        'to' => 'To',
        'subject' => 'Subject',
        'message' => 'Message',
        'send' => 'Send',
        'cancel' => 'Cancel',
        'toggle_dropdown' => 'Toggle Dropdown',
        'schedule_send' => 'Schedule send',

        'enabled' => 'Enable',
        'disabled' => 'Disabled',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'settings' => 'Settings',

        'chat' => 'Chat',
        'meeting_with_new_investors' => 'Meeting with new investors',

        'attach_files' => 'Attach Files',
        'save_to_drafts' => 'Save to Drafts',
        'dismiss_reply' => 'Dismiss Reply',
        'more_actions' => 'More Actions',
        'add_to_favourites' => 'Add to Favourites',
        'print' => 'Print',
        'move_to_trash' => 'Move to Trash',


       // invoice
        'invoice' => 'INVOICE',
        'bill_to' => 'Bill To',
        'contact_no' => 'Contact no',
        'address' => 'Address',
        'organization' => 'Organization',
        'deal_name' => 'Deal name',
        'quantity' => 'Quantity',
        'price' => 'Price',
        'amount' => 'Amount',
        'subtotal' => 'Sub total',
        'discount' => 'Discount',
        'total' => 'Total',
        'note' => 'Note',

        // calendar
        'calendar_month' => 'Month',
        'calendar_week' => 'Week',
        'calendar_day' => 'Day',

        // phone email type
        'home' => 'Home',
        'work' => 'Work',
        'office' => 'Office',

        // roles
        'app admin' => 'App Admin',
        'manager' => 'Manager',
        'agent' => 'Agent',
        'client' => 'Client',

        // class list
        'primary' => 'Primary',
        'success' => 'Success',
        'secondary' => 'Secondary',
        'danger' => 'Danger',
        'purple' => 'Purple',
        'warning' => 'Warning',
        'info' => 'Info',
        'light' => 'Light',
        'dark' => 'Dark',
        'link' => 'Link',

        // lead webform
        'webform' => 'Webform',
        'web_form_submitted' => 'Form has been submitted successfully',
        'other_info' => 'Other info',
        'person_web_form' => 'Person web form',
        'embed_code' => 'Embed code',
        'direct_link' => 'Direct link',
        'lead_web_form_notification' => 'Paste the embed code into the HTML body of the page you want to display. If your site is not (https://), you must change the URL in the embed code to just (http://).<br>Use direct link to access the web form.',
        'or_you_can' => ' Or you can ',
        'click_here' => 'click here',

        // test email
        'test_email' => 'Test Email',
        'send_test_email' => 'Send test email',
        'email_address' => 'Email address',
        'enter_message' => 'Enter message',
        'enter_email_address' => 'Enter email address',
        'email_sending_failed' => 'Email sending failed!',
        'email_sent_successfully' => 'Email sent successfully.',
        'email_setup_is_not_correct' => 'Email setup is not correct!',

        // person send email
        'send_email' => 'Send email',
        'choose_an_email_address' => 'Choose an email address',
        'write_a_message_here' => 'Write a message here',

        // activity reminder
        'reminder' => 'Reminder',
        'no_reminder' => 'Reminder not set',
        'reminder_on' => 'Reminder on',
        'set_reminder' => 'Set reminder',
        'none' => 'No reminder',
        '15mins' => '15 minutes before start',
        '30mins' => '30 minutes before start',
        '1hr' => '1 hour before start',
        '3hrs' => '3 hours before start',
        '1day' => '1 day before start',
        'custom' => 'Set custom time',
        'activity_created' => 'Activity created',
        'activity_reminder' => 'Activity reminder',

        'activity_cron_job_note' => 'You must setup the cron job in your hosted server for getting reminders for this activity.',

        // cron job
        'command' => 'Command',
        'cron_job' => 'Cron Job',
        'command_with_php_path' => 'Command with php path',
        'command_without_php_path' => 'Command without php path',
        'see_documentation' => 'See Documentation',
        'cron_job_description_message' => 'For executing scheduled jobs',
        'cron_job_setting_suggestion' => 'We are providing the cron job command and highly recommend to run it every minute(once per minute ****). Copy the command and insert it to your hosted server\'s crontab. For more help you can see the documentation.',
        'cron_job_setting_warning' => 'You must setup the cron job in your hosted server for sending bulk emails, activity notification and activity reminder.',
    ],
    require 'custom.php'
);
