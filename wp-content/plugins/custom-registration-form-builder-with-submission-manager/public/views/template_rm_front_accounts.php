<?php
if ($data->is_user) {
        $editable_forms = array(); ?>
            <div class="rm-submission" id="rm_my_details_tab" style="display: none;">
            <?php
            $cust_display = array();
            if(isset($data->submissions) && !empty($data->submissions)) {
                foreach($data->submissions as $sub) {
                    $submission = new RM_Submissions();
                    $submission->load_from_db($sub->submission_id);
                    $form_id = $submission->get_form_id();
                    $submission_id = $submission->get_submission_id();
                    $form= new RM_Forms();
                    $form->load_from_db($form_id);
                    $form_options= $form->get_form_options();
                    if(!empty($form_options->custom_status)){
                        $service = new RM_Services();
                        $custom_statuses = $service->get_custom_statuses($submission_id,$form_id);
                        $custom_status_arr = array();
                        if(!empty($custom_statuses)){
                            foreach($custom_statuses as $custom_status){
                                if(isset($form_options->custom_status[$custom_status->status_index]['cs_show_frontend']) && $form_options->custom_status[$custom_status->status_index]['cs_show_frontend'] == 1) 
                                    $cust_display[$form_options->custom_status[$custom_status->status_index]['color']] = $form_options->custom_status[$custom_status->status_index]['label'];
                            }
                        }
                    }
                }
            }
            if(isset($cust_display) && !empty($cust_display)) { ?>
            <div class="rm-submission-field-row rm-submission-status-row">
                <div class="rm-submission-label rm-custom_status-wrap">
                    <?php
                    foreach($cust_display as $color => $label) { ?>
                    <div class="rm-custom-status" style="background-color: #<?php echo esc_attr($color); ?>"><?php echo esc_html($label); ?><span style="border-color: #<?php echo esc_attr($color); ?>"></span></div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
                <div class="rm-user-details-card rm-wide-card">
                    <div class="rm-user-image-container">
                        <div class="rm-user-row dbfl">
                            <div class="rm-user-card">
                                <?php 
                                    $av = get_avatar_data($data->user->ID); 
                                    $profile_image_url = apply_filters('rm_profile_image',$av['url'],$data->user->ID);
                                ?>
                                <img alt="" src="<?php echo esc_attr($profile_image_url); ?>" class="rm-user" height="512" width="512">
                                <div class="rm-user-name-submission">
                                    <div class="rm-user-name dbfl">
                                        <span data-rm_apply_acc_color='true'><?php echo wp_kses_post((string)RM_UI_Strings::get('LABEL_WELCOME')); ?>, </span> <?php echo esc_html($data->user->display_name); ?>
                                    </div>
                                    <div class="rm-user-name-subtitle dbfl">
                                        <span <!--data-rm_apply_acc_color='true'--> <strong><?php echo esc_html($data->total_submission_count); ?></strong> </span> <?php echo wp_kses_post((string)RM_UI_Strings::get('LABEL_REGISTRATIONS')); ?>.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="rm-user-row dbfl">
                        <?php
                        if ($data->user->first_name) {
                            ?>
                            <div class="rm-field-row dbfl">
                                <div class="rm-user-field-label"><?php echo wp_kses_post((string)RM_UI_Strings::get('FIELD_TYPE_FNAME')); ?>:</div>
                                <div class="rm-user-field-value"><?php echo esc_html($data->user->first_name); ?></div>
                            </div>
                            <?php
                        }
                        if ($data->user->last_name) {
                            ?>

                            <div class="rm-field-row dbfl">
                                <div class="rm-user-field-label"><?php echo wp_kses_post((string)RM_UI_Strings::get('FIELD_TYPE_LNAME')); ?>:</div>
                                <div class="rm-user-field-value"><?php echo esc_html($data->user->last_name); ?></div>
                            </div>
                            <?php
                        }
                        if ($data->user->description) {
                            ?>

                            <div class="rm-field-row dbfl">
                                <div class="rm-user-field-label"><?php echo wp_kses_post((string)RM_UI_Strings::get('LABEL_BIO')); ?>:</div>
                                <div class="rm-user-field-value"><?php echo esc_html($data->user->description); ?></div>
                            </div>
                            <?php
                        }
                        if ($data->user->user_email) {
                            ?>

                            <div class="rm-field-row dbfl">
                                <div class="rm-user-field-label"><?php echo wp_kses_post((string)RM_UI_Strings::get('LABEL_EMAIL')); ?>:</div>
                                <div class="rm-user-field-value"><?php echo esc_html($data->user->user_email); ?></div>
                            </div>
                            <?php
                        }
                        if ($data->user->sec_email) {
                            ?>

                            <div class="rm-field-row dbfl">
                                <div class="rm-user-field-label"><?php echo wp_kses_post((string)RM_UI_Strings::get('LABEL_SECEMAIL')); ?>:</div>
                                <div class="rm-user-field-value"><?php echo esc_html($data->user->sec_email); ?></div>
                            </div>
                            <?php
                        }
                        if ($data->user->nickname) {
                            ?>

                            <div class="rm-field-row dbfl">
                                <div class="rm-user-field-label"><?php echo wp_kses_post((string)RM_UI_Strings::get('FIELD_TYPE_NICKNAME')); ?>:</div>
                                <div class="rm-user-field-value"><?php echo esc_html($data->user->nickname); ?></div>
                            </div>
                            <?php
                        }
                        if ($data->user->user_url) {
                            ?>

                            <div class="rm-field-row dbfl">
                                <div class="rm-user-field-label"><?php echo wp_kses_post((string)RM_UI_Strings::get('FIELD_TYPE_WEBSITE')); ?>:</div>
                                <div class="rm-user-field-value"><?php echo esc_url($data->user->user_url); ?></div>
                            </div>
                            <?php
                        }
                        if (is_array($data->custom_fields) || is_object($data->custom_fields))
                            foreach ($data->custom_fields as $field_id => $sub) {
                                $key = $sub->label;
                                $meta = $sub->value;
                                if (!isset($sub->type)) {
                                    $sub->type = '';
                                }

                                $sub_original = $sub;

                                $meta = RM_Utilities::strip_slash_array(maybe_unserialize($meta));
                                ?>
                                <div class="rm-field-row dbfl">

                                    <div class="rm-user-field-label"><?php echo esc_html($key); ?></div>
                                    <div class="rm-user-field-value">
                                        <?php
                                        if (is_array($meta) || is_object($meta)) {
                                            if (isset($meta['rm_field_type']) && $meta['rm_field_type'] == 'File') {
                                                unset($meta['rm_field_type']);

                                                foreach ($meta as $sub) {

                                                    $att_path = get_attached_file($sub);
                                                    $att_url = wp_get_attachment_url($sub);
                                                    ?>
                                                    <div class="rm-user-attachment">
                                                        <?php echo wp_get_attachment_link($sub, 'thumbnail', false, true, false); ?>
                                                        <div class="rm-user-attachment-field"><?php echo esc_html(basename($att_path)); ?></div>
                                                        <div class="rm-user-attachment-field"><a href="<?php echo esc_attr($att_url); ?>"><?php echo wp_kses_post((string)RM_UI_Strings::get('LABEL_DOWNLOAD')); ?></a></div>
                                                    </div>

                                                    <?php
                                                }
                                            } elseif (isset($meta['rm_field_type']) && $meta['rm_field_type'] == 'Address' && defined('REGMAGIC_ADDON')) {
                                                $sub = $meta['original'] . '<br/>';
                                                if (count($meta) === 8) {
                                                    $sub .= '<b>'.__('Street Address','custom-registration-form-builder-with-submission-manager').'</b> : ' . $meta['st_number'] . ', ' . $meta['st_route'] . '<br/>';
                                                    $sub .= '<b>'.__('City','custom-registration-form-builder-with-submission-manager').'</b> : ' . $meta['city'] . '<br/>';
                                                    $sub .= '<b>'.__('State','custom-registration-form-builder-with-submission-manager').'</b> : ' . $meta['state'] . '<br/>';
                                                    $sub .= '<b>'.__('Zip Code','custom-registration-form-builder-with-submission-manager').'</b> : ' . $meta['zip'] . '<br/>';
                                                    $sub .= '<b>'.__('Country','custom-registration-form-builder-with-submission-manager').'</b> : ' . $meta['country'];
                                                }
                                                echo wp_kses_post((string)$sub);
                                            } elseif ($sub->type == 'Time') {
                                                echo esc_html($meta['time']) . ", Timezone: " . esc_html($meta['timezone']);
                                            } elseif ($sub->type == 'Checkbox') {
                                                echo wp_kses_post((string)implode(', ', RM_Utilities::get_lable_for_option($field_id, $meta)));
                                            } elseif ($sub->type == 'URL') {
                                                $url = esc_url($meta['url']);
                                                echo wp_kses_post("<a href='$url'>$url</a>");
                                            } else {
                                                foreach($meta as $key => $value) {
                                                    if(trim((string)$value) == '')
                                                        unset($meta[$key]);
                                                }
                                                $sub = implode(', ', $meta);
                                                echo wp_kses_post((string)$sub);
                                            }
                                        } else {
                                            $additional_fields = apply_filters('rm_additional_fields', array());
                                            if(in_array($sub->type, $additional_fields)){
                                                echo do_action('rm_additional_fields_data',$sub->type, $sub->value);
                                            }
                                            elseif ($sub->type == 'Rating') {
                                                if(defined('REGMAGIC_ADDON')) {
                                                    echo wp_kses_post((string)RM_Utilities::enqueue_external_scripts('script_rm_rating', RM_ADDON_BASE_URL . 'public/js/rating3/jquery.rateit.js'));
                                                    $r_sub = array('value' => $sub->value,
                                                       'readonly' => 1,
                                                       'max_stars' => 5,
                                                       'star_face' => 'star',
                                                       'star_color' => 'FBC326');
                                                    if(isset($sub->meta) && is_object($sub->meta)) {
                                                        if(isset($sub->meta->max_stars))
                                                            $r_sub['max_stars'] = $sub->meta->max_stars;
                                                        if(isset($sub->meta->star_face))
                                                            $r_sub['star_face'] = $sub->meta->star_face;
                                                        if(isset($sub->meta->star_color))
                                                            $r_sub['star_color'] = $sub->meta->star_color;
                                                    }
                                                    $rf = new Element_Rating("", "", $r_sub);
                                                    $rf->render();
                                                } else {
                                                    echo '<div class="rateit" id="rateit5" data-rateit-min="0" data-rateit-max="5" data-rateit-value="' . wp_kses_post((string)$meta) . '" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
                                                }
                                            } elseif ($sub->type == 'Radio' || $sub->type == 'Select') {
                                                echo wp_kses_post((string)RM_Utilities::get_lable_for_option($field_id, $meta));
                                            } elseif($sub->type == 'DigitalSign'){
                                                if(!empty($meta)){
                                                    $sign_url  = RM_BASE_URL . 'plus/signature/signature-access.php?file='.$meta;
                                                
                                                    ?>
                                                    <div class="rm-user-attachment">
                                                        <img src="<?php echo esc_url($sign_url);?>" style="max-width:100px;">
                                                        <div class="rm-user-attachment-field"><a href="<?php echo esc_url($sign_url); ?>"><?php echo wp_kses_post((string)RM_UI_Strings::get('LABEL_DOWNLOAD')); ?></a></div>
                                                    </div>
                                                <?php
                                                }
                                            } else
                                                echo wp_kses_post((string)$meta);
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                                //check if any field is editable
                                if ($sub_original->is_editable == 1 && !in_array($sub_original->form_id, $editable_forms)) {
                                    $editable_forms[] = $sub_original->form_id;
                                }
                            }
                        ?>
                    </div>
                    <?php do_action('rm_after_user_details', get_current_user_id());?>
                </div>
                <?php if(!empty($editable_forms) && defined('REGMAGIC_ADDON')) { ?>
                    <div id="rm_edit_sub_link">
                        <form method="post" name="rm_form" action="" id="rmeditsubmissions">
                            <input type="hidden" name="rm_edit_user_details" value="true">
                            <input type="hidden" name="form_ids" value='<?php echo wp_kses_post((string)json_encode($editable_forms)); ?>'>
                        </form>
                        <a href="javascript:void(0)" onclick="document.getElementById('rmeditsubmissions').submit();"><?php echo wp_kses_post((string)RM_UI_Strings::get('MSG_EDIT_YOUR_SUBMISSIONS')); ?></a>
                    </div>
                <?php } ?>
            </div>
            <?php
        }