<?php
if (!defined('WPINC')) {
    die('Closed');
}
wp_enqueue_media();
$form = new RM_PFBC_Form("add-widget");
$form->configure(array(
    "prevent" => array("bootstrap", "jQuery"),
    "action" => ""
));
?>

<div class="rmagic">

    <!--Dialogue Box Starts-->
    <div class="rmcontent">
        <?php
        if (isset($data->model->field_id)) 
            $form->addElement(new Element_Hidden("field_id", $data->model->field_id));
        $form->addElement(new Element_HTML('<div class="rmheader">' . RM_UI_Strings::get("TITLE_SUB_COUNT_WIDGET_PAGE") . '</div>'));
        
        $form->addElement(new Element_Hidden("field_type",$data->selected_field));
        $form->addElement(new Element_Hidden("form_id", $data->form_id));
        
        $form->addElement(new Element_HTML('<div>'));
        $form->addElement(new Element_Textbox("<b>" . RM_UI_Strings::get('LABEL_LABEL') . ":</b>", "field_label", array("class" => "rm_static_field rm_required", "required" => "1", "value" => $data->model->field_label, "longDesc"=>RM_UI_Strings::get('HELP_ADD_WIDGET_LABEL'))));
        $form->addElement(new Element_HTML('</div>'));
        //$form->addElement(new Element_Checkbox(RM_UI_Strings::get('LABEL_SHOW_FLOATING_ICON'), "display_floating_action_btn", array("yes" => ''), $data['display_floating_action_btn'] == 'yes' ? array("value" => "yes", "longDesc" => RM_UI_Strings::get('HELP_SHOW_FLOATING_ICON')) : array("longDesc" => RM_UI_Strings::get('HELP_SHOW_FLOATING_ICON'))));
        $submission_type=array(
            "all"=>__('All', 'custom-registration-form-builder-with-submission-manager'),
            "today"=>__('Today', 'custom-registration-form-builder-with-submission-manager'),
            "week"=>__('This Week', 'custom-registration-form-builder-with-submission-manager'),
            "month"=>__('This Month', 'custom-registration-form-builder-with-submission-manager'),
            "year"=>__('This Year', 'custom-registration-form-builder-with-submission-manager'),
            "read"=>__('Read', 'custom-registration-form-builder-with-submission-manager'),
            "unread"=>__('Unread', 'custom-registration-form-builder-with-submission-manager')
            
        ); 

        $form->addElement(new Element_Textbox("<b>" . RM_UI_Strings::get('LABEL_CSS_CLASS') . ":</b>", "field_css_class", array("id" => "rm_field_class", "class" => "rm_static_field rm_required", "value" => $data->model->field_options->field_css_class, "longDesc"=>RM_UI_Strings::get('HELP_ADD_FIELD_CSS_CLASS'))));
        
        $form->addElement(new Element_HTML('<div id="rm_form_sub_count">'.'This widget will only appear if you have form submission limits enabled from "Limits" section in the form\'s "Dashboard"'.'</div>'));
        
        //Button Area
        $form->addElement(new Element_HTMLL('&#8592; &nbsp; '.__('Cancel','custom-registration-form-builder-with-submission-manager'), '?page=rm_field_manage&rm_form_id='.$data->form_id, array('class' => 'cancel')));

        $save_buttton_label = RM_UI_Strings::get('LABEL_FIELD_SAVE');

        if (isset($data->model->field_id))
            $save_buttton_label = RM_UI_Strings::get('LABEL_SAVE');

        $form->addElement(new Element_Button($save_buttton_label, "submit", array("id" => "rm_submit_btn",  "onClick" => "jQuery.prevent_field_add(event, '".RM_UI_Strings::get('MSG_REQUIRED_FIELD') ."')", "class" => "rm_btn", "name" => "submit")));
        $form->render();
        ?>
        
        
    </div>
</div>
