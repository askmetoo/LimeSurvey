<?php
/**
 * @var int $surveyId
 */
$buttons = [];
if (Permission::model()->hasSurveyPermission($surveyId, 'responses', 'update')) {
    // Delete
    $buttons[] = [
        // li element
        'type'          => 'action',
        'action'        => 'delete',
        'url'           => App()->createUrl("failedemail/delete/", ['surveyId' => $surveyId]),
        'iconClasses'   => 'fa fa-trash text-danger',
        'text'          => gT('Delete'),
        'grid-reload'   => 'yes',

        // modal
        'actionType'    => 'modal',
        'modalType'     => 'cancel-delete',
        'keepopen'      => 'no',
        'sModalTitle'   => gT('Delete failed e-mail notifications'),
        'htmlModalBody' => gT('Are you sure you want to delete the selected notifications?'),
        'aCustomDatas'  => [
            ['name' => 'surveyid', 'value' => $surveyId],
        ]
    ];
    $buttons[] = [
        'type'        => 'action',
        'action'      => 'resend',
        'url'         => App()->createUrl('failedemail/resend/', ['surveyid' => $surveyId]),
        'iconClasses' => 'fa fa-envelope',
        'text'        => gT('Resend e-mails'),
        'grid-reload' => 'yes',
        //modal
        'actionType'  => 'modal',
        'modalType'   => 'cancel-resend',
        'keepopen'    => 'yes',

        'sModalTitle'   => gT('Resend selected e-mails'),
        'htmlModalBody' => App()->getController()->renderPartial('/failedEmail/partials/modal/resend_body', [], true),
        'aCustomDatas'  => [
            ['name' => 'surveyid', 'value' => $surveyId],
        ]
    ];
}

$this->widget(
    'ext.admin.grid.MassiveActionsWidget.MassiveActionsWidget',
    [
        'pk'         => 'id',
        'gridid'     => 'failedemail-grid',
        'dropupId'   => 'failedEmailActions',
        'dropUpText' => gT('Selected e-mail(s)...'),
        'aActions'   => $buttons
    ]
);
