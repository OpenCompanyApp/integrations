<?php

namespace OpenCompany\Integrations\Pipedrive;

/**
 * Official Pipedrive OpenAPI operation metadata.
 *
 * Generated from Pipedrive's published v1 and v2 OpenAPI schemas so tool
 * discovery stays aligned with the upstream API surface.
 */
class PipedriveOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'pipedrive_add_activity_type' =>
  array (
    'slug' => 'pipedrive_add_activity_type',
    'class' => 'PipedriveAddActivityType',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/activityTypes',
    'api_version' => 'v1',
    'operation_id' => 'addActivityType',
    'name' => 'Add new activity type',
    'description' => 'Add new activity type Adds a new activity type.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_call_log' =>
  array (
    'slug' => 'pipedrive_add_call_log',
    'class' => 'PipedriveAddCallLog',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/callLogs',
    'api_version' => 'v1',
    'operation_id' => 'addCallLog',
    'name' => 'Add a call log',
    'description' => 'Add a call log Adds a new call log.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_call_log_audio_file' =>
  array (
    'slug' => 'pipedrive_add_call_log_audio_file',
    'class' => 'PipedriveAddCallLogAudioFile',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/callLogs/{id}/recordings',
    'api_version' => 'v1',
    'operation_id' => 'addCallLogAudioFile',
    'name' => 'Attach an audio file to the call log',
    'description' => 'Attach an audio file to the call log Adds an audio recording to the call log. That audio can be played by those who have access to the call log object.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID received when you create the call log',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_channel' =>
  array (
    'slug' => 'pipedrive_add_channel',
    'class' => 'PipedriveAddChannel',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/channels',
    'api_version' => 'v1',
    'operation_id' => 'addChannel',
    'name' => 'Add a channel',
    'description' => 'Add a channel Adds a new messaging channel, only admins are able to register new channels. It will use the getConversations endpoint to fetch conversations, participants and messages afterward. To use the endpoint, you need to have **Messengers integration** OAuth scope enabled and the Messaging manifest ready for the [Messaging app extension](https://pipedrive.readme.io/docs/messaging-app-extension).',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_deal_field' =>
  array (
    'slug' => 'pipedrive_add_deal_field',
    'class' => 'PipedriveAddDealField',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/dealFields',
    'api_version' => 'v1',
    'operation_id' => 'addDealField',
    'name' => 'Add a new deal field',
    'description' => 'Add a new deal field Adds a new deal field. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/adding-a-new-custom-field" target="_blank" rel="noopener noreferrer">adding a new custom field</a>.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_deal_follower' =>
  array (
    'slug' => 'pipedrive_add_deal_follower',
    'class' => 'PipedriveAddDealFollower',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/deals/{id}/followers',
    'api_version' => 'v1',
    'operation_id' => 'addDealFollower',
    'name' => 'Add a follower to a deal',
    'description' => 'Add a follower to a deal Adds a follower to a deal.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_deal_participant' =>
  array (
    'slug' => 'pipedrive_add_deal_participant',
    'class' => 'PipedriveAddDealParticipant',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/deals/{id}/participants',
    'api_version' => 'v1',
    'operation_id' => 'addDealParticipant',
    'name' => 'Add a participant to a deal',
    'description' => 'Add a participant to a deal Adds a participant to a deal.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_file' =>
  array (
    'slug' => 'pipedrive_add_file',
    'class' => 'PipedriveAddFile',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/files',
    'api_version' => 'v1',
    'operation_id' => 'addFile',
    'name' => 'Add file',
    'description' => 'Add file Lets you upload a file and associate it with a deal, person, organization, activity, product or lead. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/adding-a-file" target="_blank" rel="noopener noreferrer">adding a file</a>.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_file_and_link_it' =>
  array (
    'slug' => 'pipedrive_add_file_and_link_it',
    'class' => 'PipedriveAddFileAndLinkIt',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/files/remote',
    'api_version' => 'v1',
    'operation_id' => 'addFileAndLinkIt',
    'name' => 'Create a remote file and link it to an item',
    'description' => 'Create a remote file and link it to an item Creates a new empty file in the remote location (`googledrive`) that will be linked to the item you supply. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/adding-a-remote-file" target="_blank" rel="noopener noreferrer">adding a remote file</a>.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_filter' =>
  array (
    'slug' => 'pipedrive_add_filter',
    'class' => 'PipedriveAddFilter',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/filters',
    'api_version' => 'v1',
    'operation_id' => 'addFilter',
    'name' => 'Add a new filter',
    'description' => 'Add a new filter Adds a new filter, returns the ID upon success. Note that in the conditions JSON object only one first-level condition group is supported, and it must be glued with \'AND\', and only two second level condition groups are supported of which one must be glued with \'AND\' and the second with \'OR\'. Other combinations do not work (yet) but the syntax supports introducing them in future. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/adding-a-filter" target="_blank" rel="noopener noreferrer">adding a filter</a>.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'include_field_code',
        'argument_name' => 'include_field_code',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'If set to `true`, each condition in the response includes a `field_code` field identifying the field by its code name',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_goal' =>
  array (
    'slug' => 'pipedrive_add_goal',
    'class' => 'PipedriveAddGoal',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/goals',
    'api_version' => 'v1',
    'operation_id' => 'addGoal',
    'name' => 'Add a new goal',
    'description' => 'Add a new goal Adds a new goal. Along with adding a new goal, a report is created to track the progress of your goal.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_lead' =>
  array (
    'slug' => 'pipedrive_add_lead',
    'class' => 'PipedriveAddLead',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/leads',
    'api_version' => 'v1',
    'operation_id' => 'addLead',
    'name' => 'Add a lead',
    'description' => 'Add a lead Creates a lead. A lead always has to be linked to a person or an organization or both. All leads created through the Pipedrive API will have a lead source and origin set to `API`. Here\'s the tutorial for <a href="https://pipedrive.readme.io/docs/adding-a-lead" target="_blank" rel="noopener noreferrer">adding a lead</a>. If a lead contains custom fields, the fields\' values will be included in the response in the same format as with the `Deals` endpoints. If a custom field\'s value hasn\'t been set for the lead, it won\'t appear in the response. Please note that leads do not have a separate set of custom fields, instead they inherit the custom fields\' structure from deals. See an example given in the <a href="https://pipedrive.readme.io/docs/updating-custom-field-value" target="_blank" rel="noopener noreferrer">updating custom fields\' values tutorial</a>.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_lead_label' =>
  array (
    'slug' => 'pipedrive_add_lead_label',
    'class' => 'PipedriveAddLeadLabel',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/leadLabels',
    'api_version' => 'v1',
    'operation_id' => 'addLeadLabel',
    'name' => 'Add a lead label',
    'description' => 'Add a lead label Creates a lead label.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_note_comment' =>
  array (
    'slug' => 'pipedrive_add_note_comment',
    'class' => 'PipedriveAddNoteComment',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/notes/{id}/comments',
    'api_version' => 'v1',
    'operation_id' => 'addNoteComment',
    'name' => 'Add a comment to a note',
    'description' => 'Add a comment to a note Adds a new comment to a note.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the note',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_or_update_role_setting' =>
  array (
    'slug' => 'pipedrive_add_or_update_role_setting',
    'class' => 'PipedriveAddOrUpdateRoleSetting',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/roles/{id}/settings',
    'api_version' => 'v1',
    'operation_id' => 'addOrUpdateRoleSetting',
    'name' => 'Add or update role setting',
    'description' => 'Add or update role setting Adds or updates the visibility setting for a role.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the role',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_organization_field' =>
  array (
    'slug' => 'pipedrive_add_organization_field',
    'class' => 'PipedriveAddOrganizationField',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/organizationFields',
    'api_version' => 'v1',
    'operation_id' => 'addOrganizationField',
    'name' => 'Add a new organization field',
    'description' => 'Add a new organization field Adds a new organization field. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/adding-a-new-custom-field" target="_blank" rel="noopener noreferrer">adding a new custom field</a>.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_organization_follower' =>
  array (
    'slug' => 'pipedrive_add_organization_follower',
    'class' => 'PipedriveAddOrganizationFollower',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/organizations/{id}/followers',
    'api_version' => 'v1',
    'operation_id' => 'addOrganizationFollower',
    'name' => 'Add a follower to an organization',
    'description' => 'Add a follower to an organization Adds a follower to an organization.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_organization_relationship' =>
  array (
    'slug' => 'pipedrive_add_organization_relationship',
    'class' => 'PipedriveAddOrganizationRelationship',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/organizationRelationships',
    'api_version' => 'v1',
    'operation_id' => 'addOrganizationRelationship',
    'name' => 'Create an organization relationship',
    'description' => 'Create an organization relationship Creates and returns an organization relationship.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_person_field' =>
  array (
    'slug' => 'pipedrive_add_person_field',
    'class' => 'PipedriveAddPersonField',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/personFields',
    'api_version' => 'v1',
    'operation_id' => 'addPersonField',
    'name' => 'Add a new person field',
    'description' => 'Add a new person field Adds a new person field. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/adding-a-new-custom-field" target="_blank" rel="noopener noreferrer">adding a new custom field</a>.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_person_follower' =>
  array (
    'slug' => 'pipedrive_add_person_follower',
    'class' => 'PipedriveAddPersonFollower',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/persons/{id}/followers',
    'api_version' => 'v1',
    'operation_id' => 'addPersonFollower',
    'name' => 'Add a follower to a person',
    'description' => 'Add a follower to a person Adds a follower to a person.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_person_picture' =>
  array (
    'slug' => 'pipedrive_add_person_picture',
    'class' => 'PipedriveAddPersonPicture',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/persons/{id}/picture',
    'api_version' => 'v1',
    'operation_id' => 'addPersonPicture',
    'name' => 'Add person picture',
    'description' => 'Add person picture Adds a picture to a person. If a picture is already set, the old picture will be replaced. Added image (or the cropping parameters supplied with the request) should have an equal width and height and should be at least 128 pixels. GIF, JPG and PNG are accepted. All added images will be resized to 128 and 512 pixel wide squares.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_product_field' =>
  array (
    'slug' => 'pipedrive_add_product_field',
    'class' => 'PipedriveAddProductField',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/productFields',
    'api_version' => 'v1',
    'operation_id' => 'addProductField',
    'name' => 'Add a new product field',
    'description' => 'Add a new product field Adds a new product field. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/adding-a-new-custom-field" target="_blank" rel="noopener noreferrer">adding a new custom field</a>.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_product_follower' =>
  array (
    'slug' => 'pipedrive_add_product_follower',
    'class' => 'PipedriveAddProductFollower',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/products/{id}/followers',
    'api_version' => 'v1',
    'operation_id' => 'addProductFollower',
    'name' => 'Add a follower to a product',
    'description' => 'Add a follower to a product Adds a follower to a product.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_project' =>
  array (
    'slug' => 'pipedrive_add_project',
    'class' => 'PipedriveAddProject',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/projects',
    'api_version' => 'v1',
    'operation_id' => 'addProject',
    'name' => 'Add a project',
    'description' => 'Add a project Adds a new project. Note that you can supply additional custom fields along with the request that are not described here. These custom fields are different for each Pipedrive account and can be recognized by long hashes as keys.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_role' =>
  array (
    'slug' => 'pipedrive_add_role',
    'class' => 'PipedriveAddRole',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/roles',
    'api_version' => 'v1',
    'operation_id' => 'addRole',
    'name' => 'Add a role',
    'description' => 'Add a role Adds a new role.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_role_assignment' =>
  array (
    'slug' => 'pipedrive_add_role_assignment',
    'class' => 'PipedriveAddRoleAssignment',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/roles/{id}/assignments',
    'api_version' => 'v1',
    'operation_id' => 'addRoleAssignment',
    'name' => 'Add role assignment',
    'description' => 'Add role assignment Assigns a user to a role.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the role',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_task' =>
  array (
    'slug' => 'pipedrive_add_task',
    'class' => 'PipedriveAddTask',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/tasks',
    'api_version' => 'v1',
    'operation_id' => 'addTask',
    'name' => 'Add a task',
    'description' => 'Add a task Adds a new task.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_team' =>
  array (
    'slug' => 'pipedrive_add_team',
    'class' => 'PipedriveAddTeam',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/legacyTeams',
    'api_version' => 'v1',
    'operation_id' => 'addTeam',
    'name' => 'Add a new team',
    'description' => 'Add a new team Adds a new team to the company and returns the created object.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_team_user' =>
  array (
    'slug' => 'pipedrive_add_team_user',
    'class' => 'PipedriveAddTeamUser',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/legacyTeams/{id}/users',
    'api_version' => 'v1',
    'operation_id' => 'addTeamUser',
    'name' => 'Add users to a team',
    'description' => 'Add users to a team Adds users to an existing team.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the team',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_user' =>
  array (
    'slug' => 'pipedrive_add_user',
    'class' => 'PipedriveAddUser',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/users',
    'api_version' => 'v1',
    'operation_id' => 'addUser',
    'name' => 'Add a new user',
    'description' => 'Add a new user Adds a new user to the company, returns the ID upon success.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_add_webhook' =>
  array (
    'slug' => 'pipedrive_add_webhook',
    'class' => 'PipedriveAddWebhook',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/webhooks',
    'api_version' => 'v1',
    'operation_id' => 'addWebhook',
    'name' => 'Create a new Webhook',
    'description' => 'Create a new Webhook Creates a new Webhook and returns its details. Note that specifying an event which triggers the Webhook combines 2 parameters - `event_action` and `event_object`. E.g., use `*.*` for getting notifications about all events, `create.deal` for any newly added deals, `delete.persons` for any deleted persons, etc. See <a href="https://pipedrive.readme.io/docs/guide-for-webhooks-v2?ref=api_reference" target="_blank" rel="noopener noreferrer">the guide for Webhooks</a> for more details.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_archive_project' =>
  array (
    'slug' => 'pipedrive_archive_project',
    'class' => 'PipedriveArchiveProject',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/projects/{id}/archive',
    'api_version' => 'v1',
    'operation_id' => 'archiveProject',
    'name' => 'Archive a project',
    'description' => 'Archive a project Archives a project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_authorize' =>
  array (
    'slug' => 'pipedrive_authorize',
    'class' => 'PipedriveAuthorize',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/oauth/authorize',
    'api_version' => 'v1',
    'operation_id' => 'authorize',
    'name' => 'Requesting authorization',
    'description' => 'Requesting authorization Authorize a user by redirecting them to the Pipedrive OAuth authorization page and request their permissions to act on their behalf. This step is necessary to implement only when you allow app installation outside of the Marketplace.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'client_id',
        'argument_name' => 'client_id',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The client ID provided to you by the Pipedrive Marketplace when you register your app',
      ),
      1 =>
      array (
        'name' => 'redirect_uri',
        'argument_name' => 'redirect_uri',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The callback URL you provided when you registered your app. Authorization code will be sent to that URL (if it matches with the value you entered in the registration form) if a user approves the app install. Or, if a customer declines, the corresponding error will also be sent to this URL.',
      ),
      2 =>
      array (
        'name' => 'state',
        'argument_name' => 'state',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'You may pass any random string as the state parameter and the same string will be returned to your app after a user authorizes access. It may be used to store the user\'s session ID from your app or distinguish different responses. Using state may increase security; see RFC-6749.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_create_deal' =>
  array (
    'slug' => 'pipedrive_create_deal',
    'class' => 'PipedriveCreateDeal',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/deals',
    'api_version' => 'v2',
    'operation_id' => 'addDeal',
    'name' => 'Add a new deal',
    'description' => 'Add a new deal Adds a new deal.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_create_note' =>
  array (
    'slug' => 'pipedrive_create_note',
    'class' => 'PipedriveCreateNote',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/notes',
    'api_version' => 'v1',
    'operation_id' => 'addNote',
    'name' => 'Add a note',
    'description' => 'Add a note Adds a new note.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_create_organization' =>
  array (
    'slug' => 'pipedrive_create_organization',
    'class' => 'PipedriveCreateOrganization',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/organizations',
    'api_version' => 'v2',
    'operation_id' => 'addOrganization',
    'name' => 'Add a new organization',
    'description' => 'Add a new organization Adds a new organization.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_create_person' =>
  array (
    'slug' => 'pipedrive_create_person',
    'class' => 'PipedriveCreatePerson',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/persons',
    'api_version' => 'v2',
    'operation_id' => 'addPerson',
    'name' => 'Add a new person',
    'description' => 'Add a new person Adds a new person. If the company uses the [Campaigns product](https://pipedrive.readme.io/docs/campaigns-in-pipedrive-api), then this endpoint will also accept and return the `marketing_status` field.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_delete_activity_type' =>
  array (
    'slug' => 'pipedrive_delete_activity_type',
    'class' => 'PipedriveDeleteActivityType',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/activityTypes/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteActivityType',
    'name' => 'Delete an activity type',
    'description' => 'Delete an activity type Marks an activity type as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the activity type',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_call_log' =>
  array (
    'slug' => 'pipedrive_delete_call_log',
    'class' => 'PipedriveDeleteCallLog',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/callLogs/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteCallLog',
    'name' => 'Delete a call log',
    'description' => 'Delete a call log Deletes a call log. If there is an audio recording attached to it, it will also be deleted. The related activity will not be removed by this request. If you want to remove the related activities, please use the endpoint which is specific for activities.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID received when you create the call log',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_channel' =>
  array (
    'slug' => 'pipedrive_delete_channel',
    'class' => 'PipedriveDeleteChannel',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/channels/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteChannel',
    'name' => 'Delete a channel',
    'description' => 'Delete a channel Deletes an existing messenger\'s channel and all related entities (conversations and messages). To use the endpoint, you need to have **Messengers integration** OAuth scope enabled and the Messaging manifest ready for the [Messaging app extension](https://pipedrive.readme.io/docs/messaging-app-extension).',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the channel provided by the integration',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_comment' =>
  array (
    'slug' => 'pipedrive_delete_comment',
    'class' => 'PipedriveDeleteComment',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/notes/{id}/comments/{commentId}',
    'api_version' => 'v1',
    'operation_id' => 'deleteComment',
    'name' => 'Delete a comment related to a note',
    'description' => 'Delete a comment related to a note Deletes a comment.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the note',
      ),
      1 =>
      array (
        'name' => 'commentId',
        'argument_name' => 'comment_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the comment',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_conversation' =>
  array (
    'slug' => 'pipedrive_delete_conversation',
    'class' => 'PipedriveDeleteConversation',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/channels/{channel-id}/conversations/{conversation-id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteConversation',
    'name' => 'Delete a conversation',
    'description' => 'Delete a conversation Deletes an existing conversation. To use the endpoint, you need to have **Messengers integration** OAuth scope enabled and the Messaging manifest ready for the [Messaging app extension](https://pipedrive.readme.io/docs/messaging-app-extension).',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'channel-id',
        'argument_name' => 'channel_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the channel provided by the integration',
      ),
      1 =>
      array (
        'name' => 'conversation-id',
        'argument_name' => 'conversation_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the conversation provided by the integration',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_deal_field' =>
  array (
    'slug' => 'pipedrive_delete_deal_field',
    'class' => 'PipedriveDeleteDealField',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/dealFields/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteDealField',
    'name' => 'Delete a deal field',
    'description' => 'Delete a deal field Marks a field as deleted. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/deleting-a-custom-field" target="_blank" rel="noopener noreferrer">deleting a custom field</a>.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the field',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_deal_fields' =>
  array (
    'slug' => 'pipedrive_delete_deal_fields',
    'class' => 'PipedriveDeleteDealFields',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/dealFields',
    'api_version' => 'v1',
    'operation_id' => 'deleteDealFields',
    'name' => 'Delete multiple deal fields in bulk',
    'description' => 'Delete multiple deal fields in bulk Marks multiple deal fields as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ids',
        'argument_name' => 'ids',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The comma-separated field IDs to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_deal_follower' =>
  array (
    'slug' => 'pipedrive_delete_deal_follower',
    'class' => 'PipedriveDeleteDealFollower',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/deals/{id}/followers/{follower_id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteDealFollower',
    'name' => 'Delete a follower from a deal',
    'description' => 'Delete a follower from a deal Deletes a follower from a deal.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'follower_id',
        'argument_name' => 'follower_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the relationship between the follower and the deal',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_deal_participant' =>
  array (
    'slug' => 'pipedrive_delete_deal_participant',
    'class' => 'PipedriveDeleteDealParticipant',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/deals/{id}/participants/{deal_participant_id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteDealParticipant',
    'name' => 'Delete a participant from a deal',
    'description' => 'Delete a participant from a deal Deletes a participant from a deal.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'deal_participant_id',
        'argument_name' => 'deal_participant_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the participant of the deal',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_file' =>
  array (
    'slug' => 'pipedrive_delete_file',
    'class' => 'PipedriveDeleteFile',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/files/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteFile',
    'name' => 'Delete a file',
    'description' => 'Delete a file Marks a file as deleted. After 30 days, the file will be permanently deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the file',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_filter' =>
  array (
    'slug' => 'pipedrive_delete_filter',
    'class' => 'PipedriveDeleteFilter',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/filters/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteFilter',
    'name' => 'Delete a filter',
    'description' => 'Delete a filter Marks a filter as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the filter',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_filters' =>
  array (
    'slug' => 'pipedrive_delete_filters',
    'class' => 'PipedriveDeleteFilters',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/filters',
    'api_version' => 'v1',
    'operation_id' => 'deleteFilters',
    'name' => 'Delete multiple filters in bulk',
    'description' => 'Delete multiple filters in bulk Marks multiple filters as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ids',
        'argument_name' => 'ids',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The comma-separated filter IDs to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_goal' =>
  array (
    'slug' => 'pipedrive_delete_goal',
    'class' => 'PipedriveDeleteGoal',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/goals/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteGoal',
    'name' => 'Delete existing goal',
    'description' => 'Delete existing goal Marks a goal as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the goal',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_lead' =>
  array (
    'slug' => 'pipedrive_delete_lead',
    'class' => 'PipedriveDeleteLead',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/leads/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteLead',
    'name' => 'Delete a lead',
    'description' => 'Delete a lead Deletes a specific lead.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the lead',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_lead_label' =>
  array (
    'slug' => 'pipedrive_delete_lead_label',
    'class' => 'PipedriveDeleteLeadLabel',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/leadLabels/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteLeadLabel',
    'name' => 'Delete a lead label',
    'description' => 'Delete a lead label Deletes a specific lead label.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the lead label',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_mail_thread' =>
  array (
    'slug' => 'pipedrive_delete_mail_thread',
    'class' => 'PipedriveDeleteMailThread',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/mailbox/mailThreads/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteMailThread',
    'name' => 'Delete mail thread',
    'description' => 'Delete mail thread Marks a mail thread as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the mail thread',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_note' =>
  array (
    'slug' => 'pipedrive_delete_note',
    'class' => 'PipedriveDeleteNote',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/notes/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteNote',
    'name' => 'Delete a note',
    'description' => 'Delete a note Deletes a specific note.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the note',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_organization_field' =>
  array (
    'slug' => 'pipedrive_delete_organization_field',
    'class' => 'PipedriveDeleteOrganizationField',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/organizationFields/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteOrganizationField',
    'name' => 'Delete an organization field',
    'description' => 'Delete an organization field Marks a field as deleted. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/deleting-a-custom-field" target="_blank" rel="noopener noreferrer">deleting a custom field</a>.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the field',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_organization_fields' =>
  array (
    'slug' => 'pipedrive_delete_organization_fields',
    'class' => 'PipedriveDeleteOrganizationFields',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/organizationFields',
    'api_version' => 'v1',
    'operation_id' => 'deleteOrganizationFields',
    'name' => 'Delete multiple organization fields in bulk',
    'description' => 'Delete multiple organization fields in bulk Marks multiple fields as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ids',
        'argument_name' => 'ids',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The comma-separated field IDs to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_organization_follower' =>
  array (
    'slug' => 'pipedrive_delete_organization_follower',
    'class' => 'PipedriveDeleteOrganizationFollower',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/organizations/{id}/followers/{follower_id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteOrganizationFollower',
    'name' => 'Delete a follower from an organization',
    'description' => 'Delete a follower from an organization Deletes a follower from an organization. You can retrieve the `follower_id` from the <a href="https://developers.pipedrive.com/docs/api/v1/Organizations#getOrganizationFollowers">List followers of an organization</a> endpoint.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
      1 =>
      array (
        'name' => 'follower_id',
        'argument_name' => 'follower_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the relationship between the follower and the organization',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_organization_relationship' =>
  array (
    'slug' => 'pipedrive_delete_organization_relationship',
    'class' => 'PipedriveDeleteOrganizationRelationship',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/organizationRelationships/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteOrganizationRelationship',
    'name' => 'Delete an organization relationship',
    'description' => 'Delete an organization relationship Deletes an organization relationship and returns the deleted ID.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization relationship',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_person_field' =>
  array (
    'slug' => 'pipedrive_delete_person_field',
    'class' => 'PipedriveDeletePersonField',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/personFields/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deletePersonField',
    'name' => 'Delete a person field',
    'description' => 'Delete a person field Marks a field as deleted. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/deleting-a-custom-field" target="_blank" rel="noopener noreferrer">deleting a custom field</a>.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the field',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_person_fields' =>
  array (
    'slug' => 'pipedrive_delete_person_fields',
    'class' => 'PipedriveDeletePersonFields',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/personFields',
    'api_version' => 'v1',
    'operation_id' => 'deletePersonFields',
    'name' => 'Delete multiple person fields in bulk',
    'description' => 'Delete multiple person fields in bulk Marks multiple fields as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ids',
        'argument_name' => 'ids',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The comma-separated field IDs to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_person_follower' =>
  array (
    'slug' => 'pipedrive_delete_person_follower',
    'class' => 'PipedriveDeletePersonFollower',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/persons/{id}/followers/{follower_id}',
    'api_version' => 'v1',
    'operation_id' => 'deletePersonFollower',
    'name' => 'Delete a follower from a person',
    'description' => 'Delete a follower from a person Deletes a follower from a person.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
      1 =>
      array (
        'name' => 'follower_id',
        'argument_name' => 'follower_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the relationship between the follower and the person',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_person_picture' =>
  array (
    'slug' => 'pipedrive_delete_person_picture',
    'class' => 'PipedriveDeletePersonPicture',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/persons/{id}/picture',
    'api_version' => 'v1',
    'operation_id' => 'deletePersonPicture',
    'name' => 'Delete person picture',
    'description' => 'Delete person picture Deletes a person\'s picture.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_product_field' =>
  array (
    'slug' => 'pipedrive_delete_product_field',
    'class' => 'PipedriveDeleteProductField',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/productFields/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteProductField',
    'name' => 'Delete a product field',
    'description' => 'Delete a product field Marks a product field as deleted. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/deleting-a-custom-field" target="_blank" rel="noopener noreferrer">deleting a custom field</a>.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product field',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_product_fields' =>
  array (
    'slug' => 'pipedrive_delete_product_fields',
    'class' => 'PipedriveDeleteProductFields',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/productFields',
    'api_version' => 'v1',
    'operation_id' => 'deleteProductFields',
    'name' => 'Delete multiple product fields in bulk',
    'description' => 'Delete multiple product fields in bulk Marks multiple fields as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'ids',
        'argument_name' => 'ids',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The comma-separated field IDs to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_product_follower' =>
  array (
    'slug' => 'pipedrive_delete_product_follower',
    'class' => 'PipedriveDeleteProductFollower',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/products/{id}/followers/{follower_id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteProductFollower',
    'name' => 'Delete a follower from a product',
    'description' => 'Delete a follower from a product Deletes a follower from a product.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
      1 =>
      array (
        'name' => 'follower_id',
        'argument_name' => 'follower_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the relationship between the follower and the product',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_project' =>
  array (
    'slug' => 'pipedrive_delete_project',
    'class' => 'PipedriveDeleteProject',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/projects/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteProject',
    'name' => 'Delete a project',
    'description' => 'Delete a project Marks a project as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_role' =>
  array (
    'slug' => 'pipedrive_delete_role',
    'class' => 'PipedriveDeleteRole',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/roles/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteRole',
    'name' => 'Delete a role',
    'description' => 'Delete a role Marks a role as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the role',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_role_assignment' =>
  array (
    'slug' => 'pipedrive_delete_role_assignment',
    'class' => 'PipedriveDeleteRoleAssignment',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/roles/{id}/assignments',
    'api_version' => 'v1',
    'operation_id' => 'deleteRoleAssignment',
    'name' => 'Delete a role assignment',
    'description' => 'Delete a role assignment Removes the assigned user from a role and adds to the default role.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the role',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_delete_task' =>
  array (
    'slug' => 'pipedrive_delete_task',
    'class' => 'PipedriveDeleteTask',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/tasks/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteTask',
    'name' => 'Delete a task',
    'description' => 'Delete a task Marks a task as deleted. If the task has subtasks then those will also be deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the task',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_team_user' =>
  array (
    'slug' => 'pipedrive_delete_team_user',
    'class' => 'PipedriveDeleteTeamUser',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/legacyTeams/{id}/users',
    'api_version' => 'v1',
    'operation_id' => 'deleteTeamUser',
    'name' => 'Delete users from a team',
    'description' => 'Delete users from a team Deletes users from an existing team.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the team',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_delete_user_provider_link' =>
  array (
    'slug' => 'pipedrive_delete_user_provider_link',
    'class' => 'PipedriveDeleteUserProviderLink',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/meetings/userProviderLinks/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteUserProviderLink',
    'name' => 'Delete the link between a user and the installed video call integration',
    'description' => 'Delete the link between a user and the installed video call integration A video calling provider must call this endpoint to remove the link between a user and the installed video calling app.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Unique identifier linking a user to the installed integration',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_delete_webhook' =>
  array (
    'slug' => 'pipedrive_delete_webhook',
    'class' => 'PipedriveDeleteWebhook',
    'method' => 'DELETE',
    'base_path' => '/v1',
    'path' => '/webhooks/{id}',
    'api_version' => 'v1',
    'operation_id' => 'deleteWebhook',
    'name' => 'Delete existing Webhook',
    'description' => 'Delete existing Webhook Deletes the specified Webhook.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the Webhook to delete',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_download_file' =>
  array (
    'slug' => 'pipedrive_download_file',
    'class' => 'PipedriveDownloadFile',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/files/{id}/download',
    'api_version' => 'v1',
    'operation_id' => 'downloadFile',
    'name' => 'Download one file',
    'description' => 'Download one file Initializes a file download.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the file',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_duplicate_deal' =>
  array (
    'slug' => 'pipedrive_duplicate_deal',
    'class' => 'PipedriveDuplicateDeal',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/deals/{id}/duplicate',
    'api_version' => 'v1',
    'operation_id' => 'duplicateDeal',
    'name' => 'Duplicate deal',
    'description' => 'Duplicate deal Duplicates a deal.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_find_users_by_name' =>
  array (
    'slug' => 'pipedrive_find_users_by_name',
    'class' => 'PipedriveFindUsersByName',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/users/find',
    'api_version' => 'v1',
    'operation_id' => 'findUsersByName',
    'name' => 'Find users by name',
    'description' => 'Find users by name Finds users by their name.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'term',
        'argument_name' => 'term',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The search term to look for',
      ),
      1 =>
      array (
        'name' => 'search_by_email',
        'argument_name' => 'search_by_email',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'When enabled, the term will only be matched against email addresses of users. Default: `false`.',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_activity_fields' =>
  array (
    'slug' => 'pipedrive_get_activity_fields',
    'class' => 'PipedriveGetActivityFields',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/activityFields',
    'api_version' => 'v1',
    'operation_id' => 'getActivityFields',
    'name' => 'Get all activity fields',
    'description' => 'Get all activity fields Returns all activity fields.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_activity_types' =>
  array (
    'slug' => 'pipedrive_get_activity_types',
    'class' => 'PipedriveGetActivityTypes',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/activityTypes',
    'api_version' => 'v1',
    'operation_id' => 'getActivityTypes',
    'name' => 'Get all activity types',
    'description' => 'Get all activity types Returns all activity types.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_archived_deals' =>
  array (
    'slug' => 'pipedrive_get_archived_deals',
    'class' => 'PipedriveGetArchivedDeals',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/deals/archived',
    'api_version' => 'v1',
    'operation_id' => 'getArchivedDeals',
    'name' => 'Get all archived deals',
    'description' => 'Get all archived deals Returns all archived deals.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'argument_name' => 'user_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals matching the given user will be returned. However, `filter_id` and `owned_by_you` takes precedence over `user_id` when supplied.',
      ),
      1 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the filter to use',
      ),
      2 =>
      array (
        'name' => 'person_id',
        'argument_name' => 'person_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals linked to the specified person are returned. If filter_id is provided, this is ignored.',
      ),
      3 =>
      array (
        'name' => 'org_id',
        'argument_name' => 'org_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals linked to the specified organization are returned. If filter_id is provided, this is ignored.',
      ),
      4 =>
      array (
        'name' => 'product_id',
        'argument_name' => 'product_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals linked to the specified product are returned. If filter_id is provided, this is ignored.',
      ),
      5 =>
      array (
        'name' => 'pipeline_id',
        'argument_name' => 'pipeline_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals in the specified pipeline are returned. If filter_id is provided, this is ignored.',
      ),
      6 =>
      array (
        'name' => 'stage_id',
        'argument_name' => 'stage_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals in the specified stage are returned. If filter_id is provided, this is ignored.',
      ),
      7 =>
      array (
        'name' => 'status',
        'argument_name' => 'status',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Only fetch deals with a specific status. If omitted, all not deleted deals are returned. If set to deleted, deals that have been deleted up to 30 days ago will be included.',
        'enum' =>
        array (
          0 => 'open',
          1 => 'won',
          2 => 'lost',
          3 => 'deleted',
          4 => 'all_not_deleted',
        ),
      ),
      8 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      9 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
      10 =>
      array (
        'name' => 'sort',
        'argument_name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field names and sorting mode separated by a comma (`field_name_1 ASC`, `field_name_2 DESC`). Only first-level field keys are supported (no nested keys).',
      ),
      11 =>
      array (
        'name' => 'owned_by_you',
        'argument_name' => 'owned_by_you',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'When supplied, only deals owned by you are returned. However, `filter_id` takes precedence over `owned_by_you` when both are supplied.',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_archived_deals_summary' =>
  array (
    'slug' => 'pipedrive_get_archived_deals_summary',
    'class' => 'PipedriveGetArchivedDealsSummary',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/deals/summary/archived',
    'api_version' => 'v1',
    'operation_id' => 'getArchivedDealsSummary',
    'name' => 'Get archived deals summary',
    'description' => 'Get archived deals summary Returns a summary of all archived deals.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'status',
        'argument_name' => 'status',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Only fetch deals with a specific status. open = Open, won = Won, lost = Lost.',
        'enum' =>
        array (
          0 => 'open',
          1 => 'won',
          2 => 'lost',
        ),
      ),
      1 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => '<code>user_id</code> will not be considered. Only deals matching the given filter will be returned.',
      ),
      2 =>
      array (
        'name' => 'user_id',
        'argument_name' => 'user_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Only deals matching the given user will be returned. `user_id` will not be considered if you use `filter_id`.',
      ),
      3 =>
      array (
        'name' => 'pipeline_id',
        'argument_name' => 'pipeline_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Only deals within the given pipeline will be returned',
      ),
      4 =>
      array (
        'name' => 'stage_id',
        'argument_name' => 'stage_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Only deals within the given stage will be returned',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_archived_deals_timeline' =>
  array (
    'slug' => 'pipedrive_get_archived_deals_timeline',
    'class' => 'PipedriveGetArchivedDealsTimeline',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/deals/timeline/archived',
    'api_version' => 'v1',
    'operation_id' => 'getArchivedDealsTimeline',
    'name' => 'Get archived deals timeline',
    'description' => 'Get archived deals timeline Returns archived open and won deals, grouped by a defined interval of time set in a date-type dealField (`field_key`) - e.g. when month is the chosen interval, and 3 months are asked starting from January 1st, 2012, deals are returned grouped into 3 groups - January, February and March - based on the value of the given `field_key`.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'start_date',
        'argument_name' => 'start_date',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The date when the first interval starts. Format: YYYY-MM-DD.',
      ),
      1 =>
      array (
        'name' => 'interval',
        'argument_name' => 'interval',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The type of the interval<table><tr><th>Value</th><th>Description</th></tr><tr><td>`day`</td><td>Day</td></tr><tr><td>`week`</td><td>A full week (7 days) starting from `start_date`</td></tr><tr><td>`month`</td><td>A full month (depending on the number of days in given month) starting from `start_date`</td></tr><tr><td>`quarter`</td><td>A full quarter (3 months) starting from `start_date`</td></tr></table>',
        'enum' =>
        array (
          0 => 'day',
          1 => 'week',
          2 => 'month',
          3 => 'quarter',
        ),
      ),
      2 =>
      array (
        'name' => 'amount',
        'argument_name' => 'amount',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The number of given intervals, starting from `start_date`, to fetch. E.g. 3 (months).',
      ),
      3 =>
      array (
        'name' => 'field_key',
        'argument_name' => 'field_key',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The date field key which deals will be retrieved from',
      ),
      4 =>
      array (
        'name' => 'user_id',
        'argument_name' => 'user_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals matching the given user will be returned',
      ),
      5 =>
      array (
        'name' => 'pipeline_id',
        'argument_name' => 'pipeline_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals matching the given pipeline will be returned',
      ),
      6 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals matching the given filter will be returned',
      ),
      7 =>
      array (
        'name' => 'exclude_deals',
        'argument_name' => 'exclude_deals',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'Whether to exclude deals list (1) or not (0). Note that when deals are excluded, the timeline summary (counts and values) is still returned.',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
      8 =>
      array (
        'name' => 'totals_convert_currency',
        'argument_name' => 'totals_convert_currency',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The 3-letter currency code of any of the supported currencies. When supplied, `totals_converted` is returned per each interval which contains the currency-converted total amounts in the given currency. You may also set this parameter to `default_currency` in which case the user\'s default currency is used.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_archived_leads' =>
  array (
    'slug' => 'pipedrive_get_archived_leads',
    'class' => 'PipedriveGetArchivedLeads',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/leads/archived',
    'api_version' => 'v1',
    'operation_id' => 'getArchivedLeads',
    'name' => 'Get all archived leads',
    'description' => 'Get all archived leads Returns multiple archived leads. Leads are sorted by the time they were created, from oldest to newest. Pagination can be controlled using `limit` and `start` query parameters. If a lead contains custom fields, the fields\' values will be included in the response in the same format as with the `Deals` endpoints. If a custom field\'s value hasn\'t been set for the lead, it won\'t appear in the response. Please note that leads do not have a separate set of custom fields, instead they inherit the custom fields\' structure from deals.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned.',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the position that represents the first result for the page',
      ),
      2 =>
      array (
        'name' => 'owner_id',
        'argument_name' => 'owner_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only leads matching the given user will be returned. However, `filter_id` takes precedence over `owner_id` when supplied.',
      ),
      3 =>
      array (
        'name' => 'person_id',
        'argument_name' => 'person_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only leads matching the given person will be returned. However, `filter_id` takes precedence over `person_id` when supplied.',
      ),
      4 =>
      array (
        'name' => 'organization_id',
        'argument_name' => 'organization_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only leads matching the given organization will be returned. However, `filter_id` takes precedence over `organization_id` when supplied.',
      ),
      5 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the filter to use',
      ),
      6 =>
      array (
        'name' => 'sort',
        'argument_name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field names and sorting mode separated by a comma (`field_name_1 ASC`, `field_name_2 DESC`). Only first-level field keys are supported (no nested keys).',
        'enum' =>
        array (
          0 => 'id',
          1 => 'title',
          2 => 'owner_id',
          3 => 'creator_id',
          4 => 'was_seen',
          5 => 'expected_close_date',
          6 => 'next_activity_id',
          7 => 'add_time',
          8 => 'update_time',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_call_log' =>
  array (
    'slug' => 'pipedrive_get_call_log',
    'class' => 'PipedriveGetCallLog',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/callLogs/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getCallLog',
    'name' => 'Get details of a call log',
    'description' => 'Get details of a call log Returns details of a specific call log.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID received when you create the call log',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_comment' =>
  array (
    'slug' => 'pipedrive_get_comment',
    'class' => 'PipedriveGetComment',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/notes/{id}/comments/{commentId}',
    'api_version' => 'v1',
    'operation_id' => 'getComment',
    'name' => 'Get one comment',
    'description' => 'Get one comment Returns the details of a comment.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the note',
      ),
      1 =>
      array (
        'name' => 'commentId',
        'argument_name' => 'comment_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the comment',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_company_addons' =>
  array (
    'slug' => 'pipedrive_get_company_addons',
    'class' => 'PipedriveGetCompanyAddons',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/billing/subscriptions/addons',
    'api_version' => 'v1',
    'operation_id' => 'getCompanyAddons',
    'name' => 'Get all add-ons for a single company',
    'description' => 'Get all add-ons for a single company Returns the add-ons for a single company.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_currencies' =>
  array (
    'slug' => 'pipedrive_get_currencies',
    'class' => 'PipedriveGetCurrencies',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/currencies',
    'api_version' => 'v1',
    'operation_id' => 'getCurrencies',
    'name' => 'Get all supported currencies',
    'description' => 'Get all supported currencies Returns all supported currencies in given account which should be used when saving monetary values with other objects. The `code` parameter of the returning objects is the currency code according to ISO 4217 for all non-custom currencies.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'term',
        'argument_name' => 'term',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional search term that is searched for from currency\'s name and/or code',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_current_user' =>
  array (
    'slug' => 'pipedrive_get_current_user',
    'class' => 'PipedriveGetCurrentUser',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/users/me',
    'api_version' => 'v1',
    'operation_id' => 'getCurrentUser',
    'name' => 'Get current user data',
    'description' => 'Get current user data Returns data about an authorized user within the company with bound company data: company ID, company name, and domain. Note that the `locale` property means \'Date/number format\' in the Pipedrive account settings, not the chosen language.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_deal' =>
  array (
    'slug' => 'pipedrive_get_deal',
    'class' => 'PipedriveGetDeal',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}',
    'api_version' => 'v2',
    'operation_id' => 'getDeal',
    'name' => 'Get details of a deal',
    'description' => 'Get details of a deal Returns the details of a specific deal.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional fields to include',
        'enum' =>
        array (
          0 => 'next_activity_id',
          1 => 'last_activity_id',
          2 => 'first_won_time',
          3 => 'products_count',
          4 => 'files_count',
          5 => 'notes_count',
          6 => 'followers_count',
          7 => 'email_messages_count',
          8 => 'activities_count',
          9 => 'done_activities_count',
          10 => 'undone_activities_count',
          11 => 'participants_count',
          12 => 'last_incoming_mail_time',
          13 => 'last_outgoing_mail_time',
          14 => 'smart_bcc_email',
          15 => 'source_lead_id',
        ),
      ),
      2 =>
      array (
        'name' => 'custom_fields',
        'argument_name' => 'custom_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of custom fields keys to include. If you are only interested in a particular set of custom fields, please use this parameter for faster results and smaller response.<br/>A maximum of 15 keys is allowed.',
      ),
      3 =>
      array (
        'name' => 'include_option_labels',
        'argument_name' => 'include_option_labels',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When provided with a \'true\' value, single option and multiple option custom fields values contain objects in the form of \'{ id: number, label: string }\' instead of plain id',
      ),
      4 =>
      array (
        'name' => 'include_labels',
        'argument_name' => 'include_labels',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When provided with \'true\' value, response will include an array of label objects in the form of \'{ id: number, label: string }\'',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_deal_changelog' =>
  array (
    'slug' => 'pipedrive_get_deal_changelog',
    'class' => 'PipedriveGetDealChangelog',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/deals/{id}/changelog',
    'api_version' => 'v1',
    'operation_id' => 'getDealChangelog',
    'name' => 'List updates about deal field values',
    'description' => 'List updates about deal field values Lists updates about field values of a deal.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_deal_field' =>
  array (
    'slug' => 'pipedrive_get_deal_field',
    'class' => 'PipedriveGetDealField',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/dealFields/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getDealField',
    'name' => 'Get one deal field',
    'description' => 'Get one deal field Returns data about a specific deal field.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the field',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_deal_fields' =>
  array (
    'slug' => 'pipedrive_get_deal_fields',
    'class' => 'PipedriveGetDealFields',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/dealFields',
    'api_version' => 'v1',
    'operation_id' => 'getDealFields',
    'name' => 'Get all deal fields',
    'description' => 'Get all deal fields Returns data about all deal fields.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_deal_files' =>
  array (
    'slug' => 'pipedrive_get_deal_files',
    'class' => 'PipedriveGetDealFiles',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/deals/{id}/files',
    'api_version' => 'v1',
    'operation_id' => 'getDealFiles',
    'name' => 'List files attached to a deal',
    'description' => 'List files attached to a deal Lists files associated with a deal.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page. Please note that a maximum value of 100 is allowed.',
      ),
      3 =>
      array (
        'name' => 'sort',
        'argument_name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Supported fields: `id`, `update_time`',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_deal_followers' =>
  array (
    'slug' => 'pipedrive_get_deal_followers',
    'class' => 'PipedriveGetDealFollowers',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/deals/{id}/followers',
    'api_version' => 'v1',
    'operation_id' => 'getDealFollowers',
    'name' => 'List followers of a deal',
    'description' => 'List followers of a deal Lists the followers of a deal.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_deal_mail_messages' =>
  array (
    'slug' => 'pipedrive_get_deal_mail_messages',
    'class' => 'PipedriveGetDealMailMessages',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/deals/{id}/mailMessages',
    'api_version' => 'v1',
    'operation_id' => 'getDealMailMessages',
    'name' => 'List mail messages associated with a deal',
    'description' => 'List mail messages associated with a deal Lists mail messages associated with a deal.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_deal_participants' =>
  array (
    'slug' => 'pipedrive_get_deal_participants',
    'class' => 'PipedriveGetDealParticipants',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/deals/{id}/participants',
    'api_version' => 'v1',
    'operation_id' => 'getDealParticipants',
    'name' => 'List participants of a deal',
    'description' => 'List participants of a deal Lists the participants associated with a deal.<br>If a company uses the [Campaigns product](https://pipedrive.readme.io/docs/campaigns-in-pipedrive-api), then this endpoint will also return the `data.marketing_status` field.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_deal_participants_changelog' =>
  array (
    'slug' => 'pipedrive_get_deal_participants_changelog',
    'class' => 'PipedriveGetDealParticipantsChangelog',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/deals/{id}/participantsChangelog',
    'api_version' => 'v1',
    'operation_id' => 'getDealParticipantsChangelog',
    'name' => 'List updates about participants of a deal',
    'description' => 'List updates about participants of a deal. This is a cursor-paginated endpoint. For more information, please refer to our documentation on <a href="https://pipedrive.readme.io/docs/core-api-concepts-pagination" target="_blank" rel="noopener noreferrer">pagination</a>.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_deal_updates' =>
  array (
    'slug' => 'pipedrive_get_deal_updates',
    'class' => 'PipedriveGetDealUpdates',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/deals/{id}/flow',
    'api_version' => 'v1',
    'operation_id' => 'getDealUpdates',
    'name' => 'List updates about a deal',
    'description' => 'List updates about a deal Lists updates about a deal.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
      3 =>
      array (
        'name' => 'all_changes',
        'argument_name' => 'all_changes',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Whether to show custom field updates or not. 1 = Include custom field changes. If omitted returns changes without custom field updates.',
      ),
      4 =>
      array (
        'name' => 'items',
        'argument_name' => 'items',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A comma-separated string for filtering out item specific updates. (Possible values - call, activity, plannedActivity, change, note, deal, file, dealChange, personChange, organizationChange, follower, dealFollower, personFollower, organizationFollower, participant, comment, mailMessage, mailMessageWithAttachment, invoice, document, marketing_campaign_stat, marketing_status_change).',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_deal_users' =>
  array (
    'slug' => 'pipedrive_get_deal_users',
    'class' => 'PipedriveGetDealUsers',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/deals/{id}/permittedUsers',
    'api_version' => 'v1',
    'operation_id' => 'getDealUsers',
    'name' => 'List permitted users',
    'description' => 'List permitted users Lists the users permitted to access a deal.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_deals_summary' =>
  array (
    'slug' => 'pipedrive_get_deals_summary',
    'class' => 'PipedriveGetDealsSummary',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/deals/summary',
    'api_version' => 'v1',
    'operation_id' => 'getDealsSummary',
    'name' => 'Get deals summary',
    'description' => 'Get deals summary Returns a summary of all not archived deals.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'status',
        'argument_name' => 'status',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Only fetch deals with a specific status. open = Open, won = Won, lost = Lost.',
        'enum' =>
        array (
          0 => 'open',
          1 => 'won',
          2 => 'lost',
        ),
      ),
      1 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => '<code>user_id</code> will not be considered. Only deals matching the given filter will be returned.',
      ),
      2 =>
      array (
        'name' => 'user_id',
        'argument_name' => 'user_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Only deals matching the given user will be returned. `user_id` will not be considered if you use `filter_id`.',
      ),
      3 =>
      array (
        'name' => 'pipeline_id',
        'argument_name' => 'pipeline_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Only deals within the given pipeline will be returned',
      ),
      4 =>
      array (
        'name' => 'stage_id',
        'argument_name' => 'stage_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Only deals within the given stage will be returned',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_deals_timeline' =>
  array (
    'slug' => 'pipedrive_get_deals_timeline',
    'class' => 'PipedriveGetDealsTimeline',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/deals/timeline',
    'api_version' => 'v1',
    'operation_id' => 'getDealsTimeline',
    'name' => 'Get deals timeline',
    'description' => 'Get deals timeline Returns not archived open and won deals, grouped by a defined interval of time set in a date-type dealField (`field_key`) - e.g. when month is the chosen interval, and 3 months are asked starting from January 1st, 2012, deals are returned grouped into 3 groups - January, February and March - based on the value of the given `field_key`.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'start_date',
        'argument_name' => 'start_date',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The date when the first interval starts. Format: YYYY-MM-DD.',
      ),
      1 =>
      array (
        'name' => 'interval',
        'argument_name' => 'interval',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The type of the interval<table><tr><th>Value</th><th>Description</th></tr><tr><td>`day`</td><td>Day</td></tr><tr><td>`week`</td><td>A full week (7 days) starting from `start_date`</td></tr><tr><td>`month`</td><td>A full month (depending on the number of days in given month) starting from `start_date`</td></tr><tr><td>`quarter`</td><td>A full quarter (3 months) starting from `start_date`</td></tr></table>',
        'enum' =>
        array (
          0 => 'day',
          1 => 'week',
          2 => 'month',
          3 => 'quarter',
        ),
      ),
      2 =>
      array (
        'name' => 'amount',
        'argument_name' => 'amount',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The number of given intervals, starting from `start_date`, to fetch. E.g. 3 (months).',
      ),
      3 =>
      array (
        'name' => 'field_key',
        'argument_name' => 'field_key',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The date field key which deals will be retrieved from',
      ),
      4 =>
      array (
        'name' => 'user_id',
        'argument_name' => 'user_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals matching the given user will be returned',
      ),
      5 =>
      array (
        'name' => 'pipeline_id',
        'argument_name' => 'pipeline_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals matching the given pipeline will be returned',
      ),
      6 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals matching the given filter will be returned',
      ),
      7 =>
      array (
        'name' => 'exclude_deals',
        'argument_name' => 'exclude_deals',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'Whether to exclude deals list (1) or not (0). Note that when deals are excluded, the timeline summary (counts and values) is still returned.',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
      8 =>
      array (
        'name' => 'totals_convert_currency',
        'argument_name' => 'totals_convert_currency',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The 3-letter currency code of any of the supported currencies. When supplied, `totals_converted` is returned per each interval which contains the currency-converted total amounts in the given currency. You may also set this parameter to `default_currency` in which case the user\'s default currency is used.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_file' =>
  array (
    'slug' => 'pipedrive_get_file',
    'class' => 'PipedriveGetFile',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/files/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getFile',
    'name' => 'Get one file',
    'description' => 'Get one file Returns data about a specific file.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the file',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_files' =>
  array (
    'slug' => 'pipedrive_get_files',
    'class' => 'PipedriveGetFiles',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/files',
    'api_version' => 'v1',
    'operation_id' => 'getFiles',
    'name' => 'Get all files',
    'description' => 'Get all files Returns data about all files.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page. Please note that a maximum value of 100 is allowed.',
      ),
      2 =>
      array (
        'name' => 'sort',
        'argument_name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Supported fields: `id`, `update_time`',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_filter' =>
  array (
    'slug' => 'pipedrive_get_filter',
    'class' => 'PipedriveGetFilter',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/filters/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getFilter',
    'name' => 'Get one filter',
    'description' => 'Get one filter Returns data about a specific filter. Note that this also returns the condition lines of the filter.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the filter',
      ),
      1 =>
      array (
        'name' => 'include_field_code',
        'argument_name' => 'include_field_code',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'If set to `true`, each condition in the response includes a `field_code` field identifying the field by its code name',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_filter_helpers' =>
  array (
    'slug' => 'pipedrive_get_filter_helpers',
    'class' => 'PipedriveGetFilterHelpers',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/filters/helpers',
    'api_version' => 'v1',
    'operation_id' => 'getFilterHelpers',
    'name' => 'Get all filter helpers',
    'description' => 'Get all filter helpers Returns all supported filter helpers. It helps to know what conditions and helpers are available when you want to <a href="/docs/api/v1/Filters#addFilter">add</a> or <a href="/docs/api/v1/Filters#updateFilter">update</a> filters. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/adding-a-filter" target="_blank" rel="noopener noreferrer">adding a filter</a>.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_filters' =>
  array (
    'slug' => 'pipedrive_get_filters',
    'class' => 'PipedriveGetFilters',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/filters',
    'api_version' => 'v1',
    'operation_id' => 'getFilters',
    'name' => 'Get all filters',
    'description' => 'Get all filters Returns data about all filters.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'type',
        'argument_name' => 'type',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The types of filters to fetch',
        'enum' =>
        array (
          0 => 'deals',
          1 => 'leads',
          2 => 'org',
          3 => 'people',
          4 => 'products',
          5 => 'activity',
          6 => 'projects',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_goal_result' =>
  array (
    'slug' => 'pipedrive_get_goal_result',
    'class' => 'PipedriveGetGoalResult',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/goals/{id}/results',
    'api_version' => 'v1',
    'operation_id' => 'getGoalResult',
    'name' => 'Get result of a goal',
    'description' => 'Get result of a goal Gets the progress of a goal for the specified period.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the goal that the results are looked for',
      ),
      1 =>
      array (
        'name' => 'period.start',
        'argument_name' => 'period_start',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The start date of the period for which to find the goal\'s progress. Format: YYYY-MM-DD. This date must be the same or after the goal duration start date.',
      ),
      2 =>
      array (
        'name' => 'period.end',
        'argument_name' => 'period_end',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The end date of the period for which to find the goal\'s progress. Format: YYYY-MM-DD. This date must be the same or before the goal duration end date.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_goals' =>
  array (
    'slug' => 'pipedrive_get_goals',
    'class' => 'PipedriveGetGoals',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/goals/find',
    'api_version' => 'v1',
    'operation_id' => 'getGoals',
    'name' => 'Find goals',
    'description' => 'Find goals Returns data about goals based on criteria. For searching, append `{searchField}={searchValue}` to the URL, where `searchField` can be any one of the lowest-level fields in dot-notation (e.g. `type.params.pipeline_id`; `title`). `searchValue` should be the value you are looking for on that field. Additionally, `is_active=<true|false>` can be provided to search for only active/inactive goals. When providing `period.start`, `period.end` must also be provided and vice versa.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'type.name',
        'argument_name' => 'type_name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The type of the goal. If provided, everyone\'s goals will be returned.',
        'enum' =>
        array (
          0 => 'deals_won',
          1 => 'deals_progressed',
          2 => 'activities_completed',
          3 => 'activities_added',
          4 => 'deals_started',
        ),
      ),
      1 =>
      array (
        'name' => 'title',
        'argument_name' => 'title',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The title of the goal',
      ),
      2 =>
      array (
        'name' => 'is_active',
        'argument_name' => 'is_active',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether the goal is active or not',
      ),
      3 =>
      array (
        'name' => 'assignee.id',
        'argument_name' => 'assignee_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the user who\'s goal to fetch. When omitted, only your goals will be returned.',
      ),
      4 =>
      array (
        'name' => 'assignee.type',
        'argument_name' => 'assignee_type',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The type of the goal\'s assignee. If provided, everyone\'s goals will be returned.',
        'enum' =>
        array (
          0 => 'person',
          1 => 'company',
          2 => 'team',
        ),
      ),
      5 =>
      array (
        'name' => 'expected_outcome.target',
        'argument_name' => 'expected_outcome_target',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'The numeric value of the outcome. If provided, everyone\'s goals will be returned.',
      ),
      6 =>
      array (
        'name' => 'expected_outcome.tracking_metric',
        'argument_name' => 'expected_outcome_tracking_metric',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The tracking metric of the expected outcome of the goal. If provided, everyone\'s goals will be returned.',
        'enum' =>
        array (
          0 => 'quantity',
          1 => 'sum',
        ),
      ),
      7 =>
      array (
        'name' => 'expected_outcome.currency_id',
        'argument_name' => 'expected_outcome_currency_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The numeric ID of the goal\'s currency. Only applicable to goals with `expected_outcome.tracking_metric` with value `sum`. If provided, everyone\'s goals will be returned.',
      ),
      8 =>
      array (
        'name' => 'type.params.pipeline_id',
        'argument_name' => 'type_params_pipeline_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'An array of pipeline IDs or `null` for all pipelines. If provided, everyone\'s goals will be returned.',
        'items' =>
        array (
          'type' => 'integer',
        ),
      ),
      9 =>
      array (
        'name' => 'type.params.stage_id',
        'argument_name' => 'type_params_stage_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the stage. Applicable to only `deals_progressed` type of goals. If provided, everyone\'s goals will be returned.',
      ),
      10 =>
      array (
        'name' => 'type.params.activity_type_id',
        'argument_name' => 'type_params_activity_type_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'An array of IDs or `null` for all activity types. Only applicable for `activities_completed` and/or `activities_added` types of goals. If provided, everyone\'s goals will be returned.',
        'items' =>
        array (
          'type' => 'integer',
        ),
      ),
      11 =>
      array (
        'name' => 'period.start',
        'argument_name' => 'period_start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The start date of the period for which to find goals. Date in format of YYYY-MM-DD. When `period.start` is provided, `period.end` must be provided too.',
      ),
      12 =>
      array (
        'name' => 'period.end',
        'argument_name' => 'period_end',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The end date of the period for which to find goals. Date in format of YYYY-MM-DD.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_lead' =>
  array (
    'slug' => 'pipedrive_get_lead',
    'class' => 'PipedriveGetLead',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/leads/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getLead',
    'name' => 'Get one lead',
    'description' => 'Get one lead Returns details of a specific lead. If a lead contains custom fields, the fields\' values will be included in the response in the same format as with the `Deals` endpoints. If a custom field\'s value hasn\'t been set for the lead, it won\'t appear in the response. Please note that leads do not have a separate set of custom fields, instead they inherit the custom fields\' structure from deals.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the lead',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_lead_fields' =>
  array (
    'slug' => 'pipedrive_get_lead_fields',
    'class' => 'PipedriveGetLeadFields',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/leadFields',
    'api_version' => 'v1',
    'operation_id' => 'getLeadFields',
    'name' => 'Get all lead fields',
    'description' => 'Get all lead fields Returns data about all lead fields.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_lead_labels' =>
  array (
    'slug' => 'pipedrive_get_lead_labels',
    'class' => 'PipedriveGetLeadLabels',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/leadLabels',
    'api_version' => 'v1',
    'operation_id' => 'getLeadLabels',
    'name' => 'Get all lead labels',
    'description' => 'Get all lead labels Returns details of all lead labels. This endpoint does not support pagination and all labels are always returned.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_lead_sources' =>
  array (
    'slug' => 'pipedrive_get_lead_sources',
    'class' => 'PipedriveGetLeadSources',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/leadSources',
    'api_version' => 'v1',
    'operation_id' => 'getLeadSources',
    'name' => 'Get all lead sources',
    'description' => 'Get all lead sources Returns all lead sources. Please note that the list of lead sources is fixed, it cannot be modified. All leads created through the Pipedrive API will have a lead source `API` assigned.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_lead_users' =>
  array (
    'slug' => 'pipedrive_get_lead_users',
    'class' => 'PipedriveGetLeadUsers',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/leads/{id}/permittedUsers',
    'api_version' => 'v1',
    'operation_id' => 'getLeadUsers',
    'name' => 'List permitted users',
    'description' => 'List permitted users Lists the users permitted to access a lead.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the lead',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_leads' =>
  array (
    'slug' => 'pipedrive_get_leads',
    'class' => 'PipedriveGetLeads',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/leads',
    'api_version' => 'v1',
    'operation_id' => 'getLeads',
    'name' => 'Get all leads',
    'description' => 'Get all leads Returns multiple not archived leads. Leads are sorted by the time they were created, from oldest to newest. Pagination can be controlled using `limit` and `start` query parameters. If a lead contains custom fields, the fields\' values will be included in the response in the same format as with the `Deals` endpoints. If a custom field\'s value hasn\'t been set for the lead, it won\'t appear in the response. Please note that leads do not have a separate set of custom fields, instead they inherit the custom fields\' structure from deals.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned.',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the position that represents the first result for the page',
      ),
      2 =>
      array (
        'name' => 'owner_id',
        'argument_name' => 'owner_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only leads matching the given user will be returned. However, `filter_id` takes precedence over `owner_id` when supplied.',
      ),
      3 =>
      array (
        'name' => 'person_id',
        'argument_name' => 'person_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only leads matching the given person will be returned. However, `filter_id` takes precedence over `person_id` when supplied.',
      ),
      4 =>
      array (
        'name' => 'organization_id',
        'argument_name' => 'organization_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only leads matching the given organization will be returned. However, `filter_id` takes precedence over `organization_id` when supplied.',
      ),
      5 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the filter to use',
      ),
      6 =>
      array (
        'name' => 'updated_since',
        'argument_name' => 'updated_since',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If set, only leads with an `update_time` later than or equal to this time are returned. In ISO 8601 format, e.g. 2025-01-01T10:20:00Z.',
      ),
      7 =>
      array (
        'name' => 'sort',
        'argument_name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field names and sorting mode separated by a comma (`field_name_1 ASC`, `field_name_2 DESC`). Only first-level field keys are supported (no nested keys).',
        'enum' =>
        array (
          0 => 'id',
          1 => 'title',
          2 => 'owner_id',
          3 => 'creator_id',
          4 => 'was_seen',
          5 => 'expected_close_date',
          6 => 'next_activity_id',
          7 => 'add_time',
          8 => 'update_time',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_mail_message' =>
  array (
    'slug' => 'pipedrive_get_mail_message',
    'class' => 'PipedriveGetMailMessage',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/mailbox/mailMessages/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getMailMessage',
    'name' => 'Get one mail message',
    'description' => 'Get one mail message Returns data about a specific mail message.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the mail message to fetch',
      ),
      1 =>
      array (
        'name' => 'include_body',
        'argument_name' => 'include_body',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'Whether to include the full message body or not. `0` = Don\'t include, `1` = Include.',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_mail_thread' =>
  array (
    'slug' => 'pipedrive_get_mail_thread',
    'class' => 'PipedriveGetMailThread',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/mailbox/mailThreads/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getMailThread',
    'name' => 'Get one mail thread',
    'description' => 'Get one mail thread Returns a specific mail thread.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the mail thread',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_mail_thread_messages' =>
  array (
    'slug' => 'pipedrive_get_mail_thread_messages',
    'class' => 'PipedriveGetMailThreadMessages',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/mailbox/mailThreads/{id}/mailMessages',
    'api_version' => 'v1',
    'operation_id' => 'getMailThreadMessages',
    'name' => 'Get all mail messages of mail thread',
    'description' => 'Get all mail messages of mail thread Returns all the mail messages inside a specified mail thread.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the mail thread',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_mail_threads' =>
  array (
    'slug' => 'pipedrive_get_mail_threads',
    'class' => 'PipedriveGetMailThreads',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/mailbox/mailThreads',
    'api_version' => 'v1',
    'operation_id' => 'getMailThreads',
    'name' => 'Get mail threads',
    'description' => 'Get mail threads Returns mail threads in a specified folder ordered by the most recent message within.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'folder',
        'argument_name' => 'folder',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The type of folder to fetch',
        'enum' =>
        array (
          0 => 'inbox',
          1 => 'drafts',
          2 => 'sent',
          3 => 'archive',
        ),
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_note' =>
  array (
    'slug' => 'pipedrive_get_note',
    'class' => 'PipedriveGetNote',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/notes/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getNote',
    'name' => 'Get one note',
    'description' => 'Get one note Returns details about a specific note.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the note',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_note_comments' =>
  array (
    'slug' => 'pipedrive_get_note_comments',
    'class' => 'PipedriveGetNoteComments',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/notes/{id}/comments',
    'api_version' => 'v1',
    'operation_id' => 'getNoteComments',
    'name' => 'Get all comments for a note',
    'description' => 'Get all comments for a note Returns all comments associated with a note.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the note',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_note_fields' =>
  array (
    'slug' => 'pipedrive_get_note_fields',
    'class' => 'PipedriveGetNoteFields',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/noteFields',
    'api_version' => 'v1',
    'operation_id' => 'getNoteFields',
    'name' => 'Get all note fields',
    'description' => 'Get all note fields Returns data about all note fields.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_notes' =>
  array (
    'slug' => 'pipedrive_get_notes',
    'class' => 'PipedriveGetNotes',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/notes',
    'api_version' => 'v1',
    'operation_id' => 'getNotes',
    'name' => 'Get all notes',
    'description' => 'Get all notes Returns all notes.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'user_id',
        'argument_name' => 'user_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the user whose notes to fetch. If omitted, notes by all users will be returned.',
      ),
      1 =>
      array (
        'name' => 'lead_id',
        'argument_name' => 'lead_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The ID of the lead which notes to fetch. If omitted, notes about all leads will be returned.',
      ),
      2 =>
      array (
        'name' => 'deal_id',
        'argument_name' => 'deal_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal which notes to fetch. If omitted, notes about all deals will be returned.',
      ),
      3 =>
      array (
        'name' => 'person_id',
        'argument_name' => 'person_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the person whose notes to fetch. If omitted, notes about all persons will be returned.',
      ),
      4 =>
      array (
        'name' => 'org_id',
        'argument_name' => 'org_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization which notes to fetch. If omitted, notes about all organizations will be returned.',
      ),
      5 =>
      array (
        'name' => 'project_id',
        'argument_name' => 'project_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the project which notes to fetch. If omitted, notes about all projects will be returned.',
      ),
      6 =>
      array (
        'name' => 'task_id',
        'argument_name' => 'task_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the task which notes to fetch. If omitted, notes about all tasks will be returned.',
      ),
      7 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      8 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
      9 =>
      array (
        'name' => 'sort',
        'argument_name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field names and sorting mode separated by a comma (`field_name_1 ASC`, `field_name_2 DESC`). Only first-level field keys are supported (no nested keys). Supported fields: `id`, `user_id`, `deal_id`, `person_id`, `org_id`, `content`, `add_time`, `update_time`.',
      ),
      10 =>
      array (
        'name' => 'start_date',
        'argument_name' => 'start_date',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The date in format of YYYY-MM-DD from which notes to fetch',
      ),
      11 =>
      array (
        'name' => 'end_date',
        'argument_name' => 'end_date',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The date in format of YYYY-MM-DD until which notes to fetch to',
      ),
      12 =>
      array (
        'name' => 'updated_since',
        'argument_name' => 'updated_since',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If set, only notes with an `update_time` later than or equal to this time are returned. In RFC3339 format, e.g. 2025-01-01T10:20:00Z.',
      ),
      13 =>
      array (
        'name' => 'pinned_to_lead_flag',
        'argument_name' => 'pinned_to_lead_flag',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'If set, the results are filtered by note to lead pinning state',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
      14 =>
      array (
        'name' => 'pinned_to_deal_flag',
        'argument_name' => 'pinned_to_deal_flag',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'If set, the results are filtered by note to deal pinning state',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
      15 =>
      array (
        'name' => 'pinned_to_organization_flag',
        'argument_name' => 'pinned_to_organization_flag',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'If set, the results are filtered by note to organization pinning state',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
      16 =>
      array (
        'name' => 'pinned_to_person_flag',
        'argument_name' => 'pinned_to_person_flag',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'If set, the results are filtered by note to person pinning state',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
      17 =>
      array (
        'name' => 'pinned_to_project_flag',
        'argument_name' => 'pinned_to_project_flag',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'If set, the results are filtered by note to project pinning state',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
      18 =>
      array (
        'name' => 'pinned_to_task_flag',
        'argument_name' => 'pinned_to_task_flag',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'If set, the results are filtered by note to task pinning state',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_organization' =>
  array (
    'slug' => 'pipedrive_get_organization',
    'class' => 'PipedriveGetOrganization',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/organizations/{id}',
    'api_version' => 'v2',
    'operation_id' => 'getOrganization',
    'name' => 'Get details of a organization',
    'description' => 'Get details of a organization Returns the details of a specific organization.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
      1 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional fields to include',
        'enum' =>
        array (
          0 => 'next_activity_id',
          1 => 'last_activity_id',
          2 => 'open_deals_count',
          3 => 'related_open_deals_count',
          4 => 'closed_deals_count',
          5 => 'related_closed_deals_count',
          6 => 'email_messages_count',
          7 => 'people_count',
          8 => 'activities_count',
          9 => 'done_activities_count',
          10 => 'undone_activities_count',
          11 => 'files_count',
          12 => 'notes_count',
          13 => 'followers_count',
          14 => 'won_deals_count',
          15 => 'related_won_deals_count',
          16 => 'lost_deals_count',
          17 => 'related_lost_deals_count',
          18 => 'smart_bcc_email',
        ),
      ),
      2 =>
      array (
        'name' => 'custom_fields',
        'argument_name' => 'custom_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of custom fields keys to include. If you are only interested in a particular set of custom fields, please use this parameter for faster results and smaller response.<br/>A maximum of 15 keys is allowed.',
      ),
      3 =>
      array (
        'name' => 'include_option_labels',
        'argument_name' => 'include_option_labels',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When provided with a \'true\' value, single option and multiple option custom fields values contain objects in the form of \'{ id: number, label: string }\' instead of plain id',
      ),
      4 =>
      array (
        'name' => 'include_labels',
        'argument_name' => 'include_labels',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When provided with \'true\' value, response will include an array of label objects in the form of \'{ id: number, label: string }\'',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_organization_changelog' =>
  array (
    'slug' => 'pipedrive_get_organization_changelog',
    'class' => 'PipedriveGetOrganizationChangelog',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/organizations/{id}/changelog',
    'api_version' => 'v1',
    'operation_id' => 'getOrganizationChangelog',
    'name' => 'List updates about organization field values',
    'description' => 'List updates about organization field values Lists updates about field values of an organization.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
      1 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_organization_field' =>
  array (
    'slug' => 'pipedrive_get_organization_field',
    'class' => 'PipedriveGetOrganizationField',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/organizationFields/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getOrganizationField',
    'name' => 'Get one organization field',
    'description' => 'Get one organization field Returns data about a specific organization field.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the field',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_organization_fields' =>
  array (
    'slug' => 'pipedrive_get_organization_fields',
    'class' => 'PipedriveGetOrganizationFields',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/organizationFields',
    'api_version' => 'v1',
    'operation_id' => 'getOrganizationFields',
    'name' => 'Get all organization fields',
    'description' => 'Get all organization fields Returns data about all organization fields.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_organization_files' =>
  array (
    'slug' => 'pipedrive_get_organization_files',
    'class' => 'PipedriveGetOrganizationFiles',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/organizations/{id}/files',
    'api_version' => 'v1',
    'operation_id' => 'getOrganizationFiles',
    'name' => 'List files attached to an organization',
    'description' => 'List files attached to an organization Lists files associated with an organization.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page. Please note that a maximum value of 100 is allowed.',
      ),
      3 =>
      array (
        'name' => 'sort',
        'argument_name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Supported fields: `id`, `update_time`',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_organization_followers' =>
  array (
    'slug' => 'pipedrive_get_organization_followers',
    'class' => 'PipedriveGetOrganizationFollowers',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/organizations/{id}/followers',
    'api_version' => 'v1',
    'operation_id' => 'getOrganizationFollowers',
    'name' => 'List followers of an organization',
    'description' => 'List followers of an organization Lists the followers of an organization.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_organization_mail_messages' =>
  array (
    'slug' => 'pipedrive_get_organization_mail_messages',
    'class' => 'PipedriveGetOrganizationMailMessages',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/organizations/{id}/mailMessages',
    'api_version' => 'v1',
    'operation_id' => 'getOrganizationMailMessages',
    'name' => 'List mail messages associated with an organization',
    'description' => 'List mail messages associated with an organization Lists mail messages associated with an organization.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_organization_relationship' =>
  array (
    'slug' => 'pipedrive_get_organization_relationship',
    'class' => 'PipedriveGetOrganizationRelationship',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/organizationRelationships/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getOrganizationRelationship',
    'name' => 'Get one organization relationship',
    'description' => 'Get one organization relationship Finds and returns an organization relationship from its ID.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization relationship',
      ),
      1 =>
      array (
        'name' => 'org_id',
        'argument_name' => 'org_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the base organization for the returned calculated values',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_organization_relationships' =>
  array (
    'slug' => 'pipedrive_get_organization_relationships',
    'class' => 'PipedriveGetOrganizationRelationships',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/organizationRelationships',
    'api_version' => 'v1',
    'operation_id' => 'getOrganizationRelationships',
    'name' => 'Get all relationships for organization',
    'description' => 'Get all relationships for organization Gets all of the relationships for a supplied organization ID.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'org_id',
        'argument_name' => 'org_id',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization to get relationships for',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_organization_updates' =>
  array (
    'slug' => 'pipedrive_get_organization_updates',
    'class' => 'PipedriveGetOrganizationUpdates',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/organizations/{id}/flow',
    'api_version' => 'v1',
    'operation_id' => 'getOrganizationUpdates',
    'name' => 'List updates about an organization',
    'description' => 'List updates about an organization Lists updates about an organization.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
      3 =>
      array (
        'name' => 'all_changes',
        'argument_name' => 'all_changes',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Whether to show custom field updates or not. 1 = Include custom field changes. If omitted, returns changes without custom field updates.',
      ),
      4 =>
      array (
        'name' => 'items',
        'argument_name' => 'items',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A comma-separated string for filtering out item specific updates. (Possible values - activity, plannedActivity, note, file, change, deal, follower, participant, mailMessage, mailMessageWithAttachment, invoice, activityFile, document).',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_organization_users' =>
  array (
    'slug' => 'pipedrive_get_organization_users',
    'class' => 'PipedriveGetOrganizationUsers',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/organizations/{id}/permittedUsers',
    'api_version' => 'v1',
    'operation_id' => 'getOrganizationUsers',
    'name' => 'List permitted users',
    'description' => 'List permitted users List users permitted to access an organization.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_permission_set' =>
  array (
    'slug' => 'pipedrive_get_permission_set',
    'class' => 'PipedriveGetPermissionSet',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/permissionSets/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getPermissionSet',
    'name' => 'Get one permission set',
    'description' => 'Get one permission set Returns data about a specific permission set.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the permission set',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_permission_set_assignments' =>
  array (
    'slug' => 'pipedrive_get_permission_set_assignments',
    'class' => 'PipedriveGetPermissionSetAssignments',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/permissionSets/{id}/assignments',
    'api_version' => 'v1',
    'operation_id' => 'getPermissionSetAssignments',
    'name' => 'List permission set assignments',
    'description' => 'List permission set assignments Returns the list of assignments for a permission set.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the permission set',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_permission_sets' =>
  array (
    'slug' => 'pipedrive_get_permission_sets',
    'class' => 'PipedriveGetPermissionSets',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/permissionSets',
    'api_version' => 'v1',
    'operation_id' => 'getPermissionSets',
    'name' => 'Get all permission sets',
    'description' => 'Get all permission sets Returns data about all permission sets.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'app',
        'argument_name' => 'app',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The app to filter the permission sets by',
        'enum' =>
        array (
          0 => 'sales',
          1 => 'projects',
          2 => 'campaigns',
          3 => 'global',
          4 => 'account_settings',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_person' =>
  array (
    'slug' => 'pipedrive_get_person',
    'class' => 'PipedriveGetPerson',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/persons/{id}',
    'api_version' => 'v2',
    'operation_id' => 'getPerson',
    'name' => 'Get details of a person',
    'description' => 'Get details of a person Returns the details of a specific person. Fields `ims`, `postal_address`, `notes`, `birthday`, and `job_title` are only included if contact sync is enabled for the company.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
      1 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional fields to include. `marketing_status` and `doi_status` can only be included if the company has marketing app enabled.',
        'enum' =>
        array (
          0 => 'next_activity_id',
          1 => 'last_activity_id',
          2 => 'open_deals_count',
          3 => 'related_open_deals_count',
          4 => 'closed_deals_count',
          5 => 'related_closed_deals_count',
          6 => 'participant_open_deals_count',
          7 => 'participant_closed_deals_count',
          8 => 'email_messages_count',
          9 => 'activities_count',
          10 => 'done_activities_count',
          11 => 'undone_activities_count',
          12 => 'files_count',
          13 => 'notes_count',
          14 => 'followers_count',
          15 => 'won_deals_count',
          16 => 'related_won_deals_count',
          17 => 'lost_deals_count',
          18 => 'related_lost_deals_count',
          19 => 'last_incoming_mail_time',
          20 => 'last_outgoing_mail_time',
          21 => 'marketing_status',
          22 => 'doi_status',
          23 => 'smart_bcc_email',
        ),
      ),
      2 =>
      array (
        'name' => 'custom_fields',
        'argument_name' => 'custom_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of custom fields keys to include. If you are only interested in a particular set of custom fields, please use this parameter for faster results and smaller response.<br/>A maximum of 15 keys is allowed.',
      ),
      3 =>
      array (
        'name' => 'include_option_labels',
        'argument_name' => 'include_option_labels',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When provided with a \'true\' value, single option and multiple option custom fields values contain objects in the form of \'{ id: number, label: string }\' instead of plain id',
      ),
      4 =>
      array (
        'name' => 'include_labels',
        'argument_name' => 'include_labels',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When provided with \'true\' value, response will include an array of label objects in the form of \'{ id: number, label: string }\'',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_person_changelog' =>
  array (
    'slug' => 'pipedrive_get_person_changelog',
    'class' => 'PipedriveGetPersonChangelog',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/persons/{id}/changelog',
    'api_version' => 'v1',
    'operation_id' => 'getPersonChangelog',
    'name' => 'List updates about person field values',
    'description' => 'List updates about person field values Lists updates about field values of a person.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
      1 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_person_field' =>
  array (
    'slug' => 'pipedrive_get_person_field',
    'class' => 'PipedriveGetPersonField',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/personFields/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getPersonField',
    'name' => 'Get one person field',
    'description' => 'Get one person field Returns data about a specific person field.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the field',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_person_fields' =>
  array (
    'slug' => 'pipedrive_get_person_fields',
    'class' => 'PipedriveGetPersonFields',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/personFields',
    'api_version' => 'v1',
    'operation_id' => 'getPersonFields',
    'name' => 'Get all person fields',
    'description' => 'Get all person fields Returns data about all person fields.<br>If a company uses the [Campaigns product](https://pipedrive.readme.io/docs/campaigns-in-pipedrive-api), then this endpoint will also return the `data.marketing_status` field.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_person_files' =>
  array (
    'slug' => 'pipedrive_get_person_files',
    'class' => 'PipedriveGetPersonFiles',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/persons/{id}/files',
    'api_version' => 'v1',
    'operation_id' => 'getPersonFiles',
    'name' => 'List files attached to a person',
    'description' => 'List files attached to a person Lists files associated with a person.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page. Please note that a maximum value of 100 is allowed.',
      ),
      3 =>
      array (
        'name' => 'sort',
        'argument_name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Supported fields: `id`, `update_time`',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_person_followers' =>
  array (
    'slug' => 'pipedrive_get_person_followers',
    'class' => 'PipedriveGetPersonFollowers',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/persons/{id}/followers',
    'api_version' => 'v1',
    'operation_id' => 'getPersonFollowers',
    'name' => 'List followers of a person',
    'description' => 'List followers of a person Lists the followers of a person.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_person_mail_messages' =>
  array (
    'slug' => 'pipedrive_get_person_mail_messages',
    'class' => 'PipedriveGetPersonMailMessages',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/persons/{id}/mailMessages',
    'api_version' => 'v1',
    'operation_id' => 'getPersonMailMessages',
    'name' => 'List mail messages associated with a person',
    'description' => 'List mail messages associated with a person Lists mail messages associated with a person.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_person_products' =>
  array (
    'slug' => 'pipedrive_get_person_products',
    'class' => 'PipedriveGetPersonProducts',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/persons/{id}/products',
    'api_version' => 'v1',
    'operation_id' => 'getPersonProducts',
    'name' => 'List products associated with a person',
    'description' => 'List products associated with a person Lists products associated with a person.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_person_updates' =>
  array (
    'slug' => 'pipedrive_get_person_updates',
    'class' => 'PipedriveGetPersonUpdates',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/persons/{id}/flow',
    'api_version' => 'v1',
    'operation_id' => 'getPersonUpdates',
    'name' => 'List updates about a person',
    'description' => 'List updates about a person Lists updates about a person.<br>If a company uses the [Campaigns product](https://pipedrive.readme.io/docs/campaigns-in-pipedrive-api), then this endpoint\'s response will also include updates for the `marketing_status` field.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
      3 =>
      array (
        'name' => 'all_changes',
        'argument_name' => 'all_changes',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Whether to show custom field updates or not. 1 = Include custom field changes. If omitted returns changes without custom field updates.',
      ),
      4 =>
      array (
        'name' => 'items',
        'argument_name' => 'items',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A comma-separated string for filtering out item specific updates. (Possible values - call, activity, plannedActivity, change, note, deal, file, dealChange, personChange, organizationChange, follower, dealFollower, personFollower, organizationFollower, participant, comment, mailMessage, mailMessageWithAttachment, invoice, document, marketing_campaign_stat, marketing_status_change).',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_person_users' =>
  array (
    'slug' => 'pipedrive_get_person_users',
    'class' => 'PipedriveGetPersonUsers',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/persons/{id}/permittedUsers',
    'api_version' => 'v1',
    'operation_id' => 'getPersonUsers',
    'name' => 'List permitted users',
    'description' => 'List permitted users List users permitted to access a person.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_pipeline_conversion_statistics' =>
  array (
    'slug' => 'pipedrive_get_pipeline_conversion_statistics',
    'class' => 'PipedriveGetPipelineConversionStatistics',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/pipelines/{id}/conversion_statistics',
    'api_version' => 'v1',
    'operation_id' => 'getPipelineConversionStatistics',
    'name' => 'Get deals conversion rates in pipeline',
    'description' => 'Get deals conversion rates in pipeline Returns all stage-to-stage conversion and pipeline-to-close rates for the given time period.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the pipeline',
      ),
      1 =>
      array (
        'name' => 'start_date',
        'argument_name' => 'start_date',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The start of the period. Date in format of YYYY-MM-DD.',
      ),
      2 =>
      array (
        'name' => 'end_date',
        'argument_name' => 'end_date',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The end of the period. Date in format of YYYY-MM-DD.',
      ),
      3 =>
      array (
        'name' => 'user_id',
        'argument_name' => 'user_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the user who\'s pipeline metrics statistics to fetch. If omitted, the authorized user will be used.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_pipeline_deals' =>
  array (
    'slug' => 'pipedrive_get_pipeline_deals',
    'class' => 'PipedriveGetPipelineDeals',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/pipelines/{id}/deals',
    'api_version' => 'v1',
    'operation_id' => 'getPipelineDeals',
    'name' => 'Get deals in a pipeline',
    'description' => 'Get deals in a pipeline Lists deals in a specific pipeline across all its stages. If no parameters are provided open deals owned by the authorized user will be returned. <br>This endpoint has been deprecated. Please use <a href="https://developers.pipedrive.com/docs/api/v1/Deals#getDeals" target="_blank" rel="noopener noreferrer">GET /api/v2/deals?pipeline_id={id}</a> instead.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the pipeline',
      ),
      1 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals matching the given filter will be returned',
      ),
      2 =>
      array (
        'name' => 'user_id',
        'argument_name' => 'user_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, `filter_id` will not be considered and only deals owned by the given user will be returned. If omitted, deals owned by the authorized user will be returned.',
      ),
      3 =>
      array (
        'name' => 'everyone',
        'argument_name' => 'everyone',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'If supplied, `filter_id` and `user_id` will not be considered - instead, deals owned by everyone will be returned',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
      4 =>
      array (
        'name' => 'stage_id',
        'argument_name' => 'stage_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals within the given stage will be returned',
      ),
      5 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      6 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
      7 =>
      array (
        'name' => 'get_summary',
        'argument_name' => 'get_summary',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'Whether to include a summary of the pipeline in the `additional_data` or not',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
      8 =>
      array (
        'name' => 'totals_convert_currency',
        'argument_name' => 'totals_convert_currency',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The 3-letter currency code of any of the supported currencies. When supplied, `per_stages_converted` is returned inside `deals_summary` inside `additional_data` which contains the currency-converted total amounts in the given currency per each stage. You may also set this parameter to `default_currency` in which case users default currency is used. Only works when `get_summary` parameter flag is enabled.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_pipeline_movement_statistics' =>
  array (
    'slug' => 'pipedrive_get_pipeline_movement_statistics',
    'class' => 'PipedriveGetPipelineMovementStatistics',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/pipelines/{id}/movement_statistics',
    'api_version' => 'v1',
    'operation_id' => 'getPipelineMovementStatistics',
    'name' => 'Get deals movements in pipeline',
    'description' => 'Get deals movements in pipeline Returns statistics for deals movements for the given time period.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the pipeline',
      ),
      1 =>
      array (
        'name' => 'start_date',
        'argument_name' => 'start_date',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The start of the period. Date in format of YYYY-MM-DD.',
      ),
      2 =>
      array (
        'name' => 'end_date',
        'argument_name' => 'end_date',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The end of the period. Date in format of YYYY-MM-DD.',
      ),
      3 =>
      array (
        'name' => 'user_id',
        'argument_name' => 'user_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the user who\'s pipeline statistics to fetch. If omitted, the authorized user will be used.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_product_deals' =>
  array (
    'slug' => 'pipedrive_get_product_deals',
    'class' => 'PipedriveGetProductDeals',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/products/{id}/deals',
    'api_version' => 'v1',
    'operation_id' => 'getProductDeals',
    'name' => 'Get deals where a product is attached to',
    'description' => 'Get deals where a product is attached to Returns data about deals that have a product attached to it.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
      3 =>
      array (
        'name' => 'status',
        'argument_name' => 'status',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Only fetch deals with a specific status. If omitted, all not deleted deals are returned. If set to deleted, deals that have been deleted up to 30 days ago will be included.',
        'enum' =>
        array (
          0 => 'open',
          1 => 'won',
          2 => 'lost',
          3 => 'deleted',
          4 => 'all_not_deleted',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_product_field' =>
  array (
    'slug' => 'pipedrive_get_product_field',
    'class' => 'PipedriveGetProductField',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/productFields/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getProductField',
    'name' => 'Get one product field',
    'description' => 'Get one product field Returns data about a specific product field.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product field',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_product_fields' =>
  array (
    'slug' => 'pipedrive_get_product_fields',
    'class' => 'PipedriveGetProductFields',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/productFields',
    'api_version' => 'v1',
    'operation_id' => 'getProductFields',
    'name' => 'Get all product fields',
    'description' => 'Get all product fields Returns data about all product fields.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_product_files' =>
  array (
    'slug' => 'pipedrive_get_product_files',
    'class' => 'PipedriveGetProductFiles',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/products/{id}/files',
    'api_version' => 'v1',
    'operation_id' => 'getProductFiles',
    'name' => 'List files attached to a product',
    'description' => 'List files attached to a product Lists files associated with a product.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page. Please note that a maximum value of 100 is allowed.',
      ),
      3 =>
      array (
        'name' => 'sort',
        'argument_name' => 'sort',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Supported fields: `id`, `update_time`',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_product_followers' =>
  array (
    'slug' => 'pipedrive_get_product_followers',
    'class' => 'PipedriveGetProductFollowers',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/products/{id}/followers',
    'api_version' => 'v1',
    'operation_id' => 'getProductFollowers',
    'name' => 'List followers of a product',
    'description' => 'List followers of a product Lists the followers of a product.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_product_users' =>
  array (
    'slug' => 'pipedrive_get_product_users',
    'class' => 'PipedriveGetProductUsers',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/products/{id}/permittedUsers',
    'api_version' => 'v1',
    'operation_id' => 'getProductUsers',
    'name' => 'List permitted users',
    'description' => 'List permitted users Lists users permitted to access a product.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_project' =>
  array (
    'slug' => 'pipedrive_get_project',
    'class' => 'PipedriveGetProject',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/projects/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getProject',
    'name' => 'Get details of a project',
    'description' => 'Get details of a project Returns the details of a specific project. Also note that custom fields appear as long hashes in the resulting data. These hashes can be mapped against the `key` value of project fields.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_project_activities' =>
  array (
    'slug' => 'pipedrive_get_project_activities',
    'class' => 'PipedriveGetProjectActivities',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/projects/{id}/activities',
    'api_version' => 'v1',
    'operation_id' => 'getProjectActivities',
    'name' => 'Returns project activities',
    'description' => 'Returns project activities Returns activities linked to a specific project.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_project_groups' =>
  array (
    'slug' => 'pipedrive_get_project_groups',
    'class' => 'PipedriveGetProjectGroups',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/projects/{id}/groups',
    'api_version' => 'v1',
    'operation_id' => 'getProjectGroups',
    'name' => 'Returns project groups',
    'description' => 'Returns project groups Returns all active groups under a specific project.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_project_plan' =>
  array (
    'slug' => 'pipedrive_get_project_plan',
    'class' => 'PipedriveGetProjectPlan',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/projects/{id}/plan',
    'api_version' => 'v1',
    'operation_id' => 'getProjectPlan',
    'name' => 'Returns project plan',
    'description' => 'Returns project plan Returns information about items in a project plan. Items consists of tasks and activities and are linked to specific project phase and group.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_project_tasks' =>
  array (
    'slug' => 'pipedrive_get_project_tasks',
    'class' => 'PipedriveGetProjectTasks',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/projects/{id}/tasks',
    'api_version' => 'v1',
    'operation_id' => 'getProjectTasks',
    'name' => 'Returns project tasks',
    'description' => 'Returns project tasks Returns tasks linked to a specific project.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_project_template' =>
  array (
    'slug' => 'pipedrive_get_project_template',
    'class' => 'PipedriveGetProjectTemplate',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/projectTemplates/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getProjectTemplate',
    'name' => 'Get details of a template',
    'description' => 'Get details of a template Returns the details of a specific project template.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project template',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_project_templates' =>
  array (
    'slug' => 'pipedrive_get_project_templates',
    'class' => 'PipedriveGetProjectTemplates',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/projectTemplates',
    'api_version' => 'v1',
    'operation_id' => 'getProjectTemplates',
    'name' => 'Get all project templates',
    'description' => 'Get all project templates Returns all not deleted project templates. This is a cursor-paginated endpoint. For more information, please refer to our documentation on <a href="https://pipedrive.readme.io/docs/core-api-concepts-pagination" target="_blank" rel="noopener noreferrer">pagination</a>.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, up to 500 items will be returned.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_projects' =>
  array (
    'slug' => 'pipedrive_get_projects',
    'class' => 'PipedriveGetProjects',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/projects',
    'api_version' => 'v1',
    'operation_id' => 'getProjects',
    'name' => 'Get all projects',
    'description' => 'Get all projects Returns all projects. This is a cursor-paginated endpoint. For more information, please refer to our documentation on <a href="https://pipedrive.readme.io/docs/core-api-concepts-pagination" target="_blank" rel="noopener noreferrer">pagination</a>.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned.',
      ),
      2 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the filter to use',
      ),
      3 =>
      array (
        'name' => 'status',
        'argument_name' => 'status',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If supplied, includes only projects with the specified statuses. Possible values are `open`, `completed`, `canceled` and `deleted`. By default `deleted` projects are not returned.',
      ),
      4 =>
      array (
        'name' => 'phase_id',
        'argument_name' => 'phase_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only projects in specified phase are returned',
      ),
      5 =>
      array (
        'name' => 'include_archived',
        'argument_name' => 'include_archived',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'If supplied with `true` then archived projects are also included in the response. By default only not archived projects are returned.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_projects_board' =>
  array (
    'slug' => 'pipedrive_get_projects_board',
    'class' => 'PipedriveGetProjectsBoard',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/projects/boards/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getProjectsBoard',
    'name' => 'Get details of a board',
    'description' => 'Get details of a board Returns the details of a specific project board.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project board',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_projects_boards' =>
  array (
    'slug' => 'pipedrive_get_projects_boards',
    'class' => 'PipedriveGetProjectsBoards',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/projects/boards',
    'api_version' => 'v1',
    'operation_id' => 'getProjectsBoards',
    'name' => 'Get all project boards',
    'description' => 'Get all project boards Returns all projects boards that are not deleted.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_projects_phase' =>
  array (
    'slug' => 'pipedrive_get_projects_phase',
    'class' => 'PipedriveGetProjectsPhase',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/projects/phases/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getProjectsPhase',
    'name' => 'Get details of a phase',
    'description' => 'Get details of a phase Returns the details of a specific project phase.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project phase',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_projects_phases' =>
  array (
    'slug' => 'pipedrive_get_projects_phases',
    'class' => 'PipedriveGetProjectsPhases',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/projects/phases',
    'api_version' => 'v1',
    'operation_id' => 'getProjectsPhases',
    'name' => 'Get project phases',
    'description' => 'Get project phases Returns all active project phases under a specific board.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'board_id',
        'argument_name' => 'board_id',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'ID of the board for which phases are requested',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_recents' =>
  array (
    'slug' => 'pipedrive_get_recents',
    'class' => 'PipedriveGetRecents',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/recents',
    'api_version' => 'v1',
    'operation_id' => 'getRecents',
    'name' => 'Get recents',
    'description' => 'Get recents Returns data about all recent changes occurred after the given timestamp.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'since_timestamp',
        'argument_name' => 'since_timestamp',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The timestamp in UTC. Format: YYYY-MM-DD HH:MM:SS.',
      ),
      1 =>
      array (
        'name' => 'items',
        'argument_name' => 'items',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Multiple selection of item types to include in the query (optional)',
        'enum' =>
        array (
          0 => 'activity',
          1 => 'activityType',
          2 => 'deal',
          3 => 'file',
          4 => 'filter',
          5 => 'note',
          6 => 'person',
          7 => 'organization',
          8 => 'pipeline',
          9 => 'product',
          10 => 'stage',
          11 => 'user',
        ),
      ),
      2 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      3 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_role' =>
  array (
    'slug' => 'pipedrive_get_role',
    'class' => 'PipedriveGetRole',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/roles/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getRole',
    'name' => 'Get one role',
    'description' => 'Get one role Returns the details of a specific role.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the role',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_role_assignments' =>
  array (
    'slug' => 'pipedrive_get_role_assignments',
    'class' => 'PipedriveGetRoleAssignments',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/roles/{id}/assignments',
    'api_version' => 'v1',
    'operation_id' => 'getRoleAssignments',
    'name' => 'List role assignments',
    'description' => 'List role assignments Returns all users assigned to a role.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the role',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_role_pipelines' =>
  array (
    'slug' => 'pipedrive_get_role_pipelines',
    'class' => 'PipedriveGetRolePipelines',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/roles/{id}/pipelines',
    'api_version' => 'v1',
    'operation_id' => 'getRolePipelines',
    'name' => 'List pipeline visibility for a role',
    'description' => 'List pipeline visibility for a role Returns the list of either visible or hidden pipeline IDs for a specific role. For more information on pipeline visibility, please refer to the <a href="https://support.pipedrive.com/en/article/visibility-groups" target="_blank" rel="noopener noreferrer">Visibility groups article</a>.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the role',
      ),
      1 =>
      array (
        'name' => 'visible',
        'argument_name' => 'visible',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to return the visible or hidden pipelines for the role',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_role_settings' =>
  array (
    'slug' => 'pipedrive_get_role_settings',
    'class' => 'PipedriveGetRoleSettings',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/roles/{id}/settings',
    'api_version' => 'v1',
    'operation_id' => 'getRoleSettings',
    'name' => 'List role settings',
    'description' => 'List role settings Returns the visibility settings of a specific role.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the role',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_roles' =>
  array (
    'slug' => 'pipedrive_get_roles',
    'class' => 'PipedriveGetRoles',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/roles',
    'api_version' => 'v1',
    'operation_id' => 'getRoles',
    'name' => 'Get all roles',
    'description' => 'Get all roles Returns all the roles within the company.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_stage_deals' =>
  array (
    'slug' => 'pipedrive_get_stage_deals',
    'class' => 'PipedriveGetStageDeals',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/stages/{id}/deals',
    'api_version' => 'v1',
    'operation_id' => 'getStageDeals',
    'name' => 'Get deals in a stage',
    'description' => 'Get deals in a stage Lists deals in a specific stage. If no parameters are provided open deals owned by the authorized user will be returned. <br>This endpoint has been deprecated. Please use <a href="https://developers.pipedrive.com/docs/api/v1/Deals#getDeals" target="_blank" rel="noopener noreferrer">GET /api/v2/deals?stage_id={id}</a> instead.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the stage',
      ),
      1 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals matching the given filter will be returned',
      ),
      2 =>
      array (
        'name' => 'user_id',
        'argument_name' => 'user_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, `filter_id` will not be considered and only deals owned by the given user will be returned. If omitted, deals owned by the authorized user will be returned.',
      ),
      3 =>
      array (
        'name' => 'everyone',
        'argument_name' => 'everyone',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'If supplied, `filter_id` and `user_id` will not be considered - instead, deals owned by everyone will be returned',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
      4 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      5 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_task' =>
  array (
    'slug' => 'pipedrive_get_task',
    'class' => 'PipedriveGetTask',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/tasks/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getTask',
    'name' => 'Get details of a task',
    'description' => 'Get details of a task Returns the details of a specific task.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the task',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_tasks' =>
  array (
    'slug' => 'pipedrive_get_tasks',
    'class' => 'PipedriveGetTasks',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/tasks',
    'api_version' => 'v1',
    'operation_id' => 'getTasks',
    'name' => 'Get all tasks',
    'description' => 'Get all tasks Returns all tasks. This is a cursor-paginated endpoint. For more information, please refer to our documentation on <a href="https://pipedrive.readme.io/docs/core-api-concepts-pagination" target="_blank" rel="noopener noreferrer">pagination</a>.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, up to 500 items will be returned.',
      ),
      2 =>
      array (
        'name' => 'assignee_id',
        'argument_name' => 'assignee_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only tasks that are assigned to this user are returned',
      ),
      3 =>
      array (
        'name' => 'project_id',
        'argument_name' => 'project_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only tasks that are assigned to this project are returned',
      ),
      4 =>
      array (
        'name' => 'parent_task_id',
        'argument_name' => 'parent_task_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If `null` is supplied then only parent tasks are returned. If integer is supplied then only subtasks of a specific task are returned. By default all tasks are returned.',
      ),
      5 =>
      array (
        'name' => 'done',
        'argument_name' => 'done',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'Whether the task is done or not. `0` = Not done, `1` = Done. If not omitted then returns both done and not done tasks.',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_team' =>
  array (
    'slug' => 'pipedrive_get_team',
    'class' => 'PipedriveGetTeam',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/legacyTeams/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getTeam',
    'name' => 'Get a single team',
    'description' => 'Get a single team Returns data about a specific team.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the team',
      ),
      1 =>
      array (
        'name' => 'skip_users',
        'argument_name' => 'skip_users',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'When enabled, the teams will not include IDs of member users',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_team_users' =>
  array (
    'slug' => 'pipedrive_get_team_users',
    'class' => 'PipedriveGetTeamUsers',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/legacyTeams/{id}/users',
    'api_version' => 'v1',
    'operation_id' => 'getTeamUsers',
    'name' => 'Get all users in a team',
    'description' => 'Get all users in a team Returns a list of all user IDs within a team.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the team',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_teams' =>
  array (
    'slug' => 'pipedrive_get_teams',
    'class' => 'PipedriveGetTeams',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/legacyTeams',
    'api_version' => 'v1',
    'operation_id' => 'getTeams',
    'name' => 'Get all teams',
    'description' => 'Get all teams Returns data about teams within the company.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'order_by',
        'argument_name' => 'order_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field name to sort returned teams by',
        'enum' =>
        array (
          0 => 'id',
          1 => 'name',
          2 => 'manager_id',
          3 => 'active_flag',
        ),
      ),
      1 =>
      array (
        'name' => 'skip_users',
        'argument_name' => 'skip_users',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'When enabled, the teams will not include IDs of member users',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_tokens' =>
  array (
    'slug' => 'pipedrive_get_tokens',
    'class' => 'PipedriveGetTokens',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/oauth/token',
    'api_version' => 'v1',
    'operation_id' => 'get-tokens',
    'name' => 'Getting the tokens',
    'description' => 'Getting the tokens After the customer has confirmed the app installation, you will need to exchange the `authorization_code` to a pair of access and refresh tokens. Using an access token, you can access the user\'s data through the API.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'Authorization',
        'argument_name' => 'authorization',
        'in' => 'header',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Base 64 encoded string containing the `client_id` and `client_secret` values. The header value should be `Basic <base64(client_id:client_secret)>`.',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_get_user' =>
  array (
    'slug' => 'pipedrive_get_user',
    'class' => 'PipedriveGetUser',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/users/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getUser',
    'name' => 'Get one user',
    'description' => 'Get one user Returns data about a specific user within the company.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the user',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_user_call_logs' =>
  array (
    'slug' => 'pipedrive_get_user_call_logs',
    'class' => 'PipedriveGetUserCallLogs',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/callLogs',
    'api_version' => 'v1',
    'operation_id' => 'getUserCallLogs',
    'name' => 'Get all call logs assigned to a particular user',
    'description' => 'Get all call logs assigned to a particular user Returns all call logs assigned to a particular user.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. The upper limit is 50.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_user_connections' =>
  array (
    'slug' => 'pipedrive_get_user_connections',
    'class' => 'PipedriveGetUserConnections',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/userConnections',
    'api_version' => 'v1',
    'operation_id' => 'getUserConnections',
    'name' => 'Get all user connections',
    'description' => 'Get all user connections Returns data about all connections for the authorized user.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_user_followers' =>
  array (
    'slug' => 'pipedrive_get_user_followers',
    'class' => 'PipedriveGetUserFollowers',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/users/{id}/followers',
    'api_version' => 'v1',
    'operation_id' => 'getUserFollowers',
    'name' => 'List followers of a user',
    'description' => 'List followers of a user Lists the followers of a specific user.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the user',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_user_permissions' =>
  array (
    'slug' => 'pipedrive_get_user_permissions',
    'class' => 'PipedriveGetUserPermissions',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/users/{id}/permissions',
    'api_version' => 'v1',
    'operation_id' => 'getUserPermissions',
    'name' => 'List user permissions',
    'description' => 'List user permissions Lists aggregated permissions over all assigned permission sets for a user.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the user',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_user_role_assignments' =>
  array (
    'slug' => 'pipedrive_get_user_role_assignments',
    'class' => 'PipedriveGetUserRoleAssignments',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/users/{id}/roleAssignments',
    'api_version' => 'v1',
    'operation_id' => 'getUserRoleAssignments',
    'name' => 'List role assignments',
    'description' => 'List role assignments Lists role assignments for a user.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the user',
      ),
      1 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_user_role_settings' =>
  array (
    'slug' => 'pipedrive_get_user_role_settings',
    'class' => 'PipedriveGetUserRoleSettings',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/users/{id}/roleSettings',
    'api_version' => 'v1',
    'operation_id' => 'getUserRoleSettings',
    'name' => 'List user role settings',
    'description' => 'List user role settings Lists the settings of user\'s assigned role.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the user',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_user_settings' =>
  array (
    'slug' => 'pipedrive_get_user_settings',
    'class' => 'PipedriveGetUserSettings',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/userSettings',
    'api_version' => 'v1',
    'operation_id' => 'getUserSettings',
    'name' => 'List settings of an authorized user',
    'description' => 'List settings of an authorized user Lists the settings of an authorized user. Example response contains a shortened list of settings.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_user_teams' =>
  array (
    'slug' => 'pipedrive_get_user_teams',
    'class' => 'PipedriveGetUserTeams',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/legacyTeams/user/{id}',
    'api_version' => 'v1',
    'operation_id' => 'getUserTeams',
    'name' => 'Get all teams of a user',
    'description' => 'Get all teams of a user Returns data about all teams which have the specified user as a member.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the user',
      ),
      1 =>
      array (
        'name' => 'order_by',
        'argument_name' => 'order_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field name to sort returned teams by',
        'enum' =>
        array (
          0 => 'id',
          1 => 'name',
          2 => 'manager_id',
          3 => 'active_flag',
        ),
      ),
      2 =>
      array (
        'name' => 'skip_users',
        'argument_name' => 'skip_users',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'number',
        'description' => 'When enabled, the teams will not include IDs of member users',
        'enum' =>
        array (
          0 => '0',
          1 => '1',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_users' =>
  array (
    'slug' => 'pipedrive_get_users',
    'class' => 'PipedriveGetUsers',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/users',
    'api_version' => 'v1',
    'operation_id' => 'getUsers',
    'name' => 'Get all users',
    'description' => 'Get all users Returns data about all users within the company.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pipedrive_get_webhooks' =>
  array (
    'slug' => 'pipedrive_get_webhooks',
    'class' => 'PipedriveGetWebhooks',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/webhooks',
    'api_version' => 'v1',
    'operation_id' => 'getWebhooks',
    'name' => 'Get all Webhooks',
    'description' => 'Get all Webhooks Returns data about all the Webhooks of a company.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pipedrive_link_file_to_item' =>
  array (
    'slug' => 'pipedrive_link_file_to_item',
    'class' => 'PipedriveLinkFileToItem',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/files/remoteLink',
    'api_version' => 'v1',
    'operation_id' => 'linkFileToItem',
    'name' => 'Link a remote file to an item',
    'description' => 'Link a remote file to an item Links an existing remote file (`googledrive`) to the item you supply. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/adding-a-remote-file" target="_blank" rel="noopener noreferrer">adding a remote file</a>.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_list_deals' =>
  array (
    'slug' => 'pipedrive_list_deals',
    'class' => 'PipedriveListDeals',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/deals',
    'api_version' => 'v2',
    'operation_id' => 'getDeals',
    'name' => 'Get all deals',
    'description' => 'Get all deals Returns data about all not archived deals.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals matching the specified filter are returned',
      ),
      1 =>
      array (
        'name' => 'ids',
        'argument_name' => 'ids',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of up to 100 entity ids to fetch. If filter_id is provided, this is ignored. If any of the requested entities do not exist or are not visible, they are not included in the response.',
      ),
      2 =>
      array (
        'name' => 'owner_id',
        'argument_name' => 'owner_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals owned by the specified user are returned. If filter_id is provided, this is ignored.',
      ),
      3 =>
      array (
        'name' => 'person_id',
        'argument_name' => 'person_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals linked to the specified person are returned. If filter_id is provided, this is ignored.',
      ),
      4 =>
      array (
        'name' => 'org_id',
        'argument_name' => 'org_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals linked to the specified organization are returned. If filter_id is provided, this is ignored.',
      ),
      5 =>
      array (
        'name' => 'pipeline_id',
        'argument_name' => 'pipeline_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals in the specified pipeline are returned. If filter_id is provided, this is ignored.',
      ),
      6 =>
      array (
        'name' => 'stage_id',
        'argument_name' => 'stage_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals in the specified stage are returned. If filter_id is provided, this is ignored.',
      ),
      7 =>
      array (
        'name' => 'status',
        'argument_name' => 'status',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Only fetch deals with a specific status. If omitted, all not deleted deals are returned. If set to deleted, deals that have been deleted up to 30 days ago will be included. Multiple statuses can be included as a comma separated array. If filter_id is provided, this is ignored.',
        'enum' =>
        array (
          0 => 'open',
          1 => 'won',
          2 => 'lost',
          3 => 'deleted',
        ),
      ),
      8 =>
      array (
        'name' => 'updated_since',
        'argument_name' => 'updated_since',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If set, only deals with an `update_time` later than or equal to this time are returned. In RFC3339 format, e.g. 2025-01-01T10:20:00Z.',
      ),
      9 =>
      array (
        'name' => 'updated_until',
        'argument_name' => 'updated_until',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If set, only deals with an `update_time` earlier than this time are returned. In RFC3339 format, e.g. 2025-01-01T10:20:00Z.',
      ),
      10 =>
      array (
        'name' => 'sort_by',
        'argument_name' => 'sort_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field to sort by. Supported fields: `id`, `update_time`, `add_time`.',
        'enum' =>
        array (
          0 => 'id',
          1 => 'update_time',
          2 => 'add_time',
        ),
      ),
      11 =>
      array (
        'name' => 'sort_direction',
        'argument_name' => 'sort_direction',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The sorting direction. Supported values: `asc`, `desc`.',
        'enum' =>
        array (
          0 => 'asc',
          1 => 'desc',
        ),
      ),
      12 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional fields to include',
        'enum' =>
        array (
          0 => 'next_activity_id',
          1 => 'last_activity_id',
          2 => 'first_won_time',
          3 => 'products_count',
          4 => 'files_count',
          5 => 'notes_count',
          6 => 'followers_count',
          7 => 'email_messages_count',
          8 => 'activities_count',
          9 => 'done_activities_count',
          10 => 'undone_activities_count',
          11 => 'participants_count',
          12 => 'last_incoming_mail_time',
          13 => 'last_outgoing_mail_time',
          14 => 'smart_bcc_email',
          15 => 'source_lead_id',
        ),
      ),
      13 =>
      array (
        'name' => 'custom_fields',
        'argument_name' => 'custom_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of custom fields keys to include. If you are only interested in a particular set of custom fields, please use this parameter for faster results and smaller response.<br/>A maximum of 15 keys is allowed.',
      ),
      14 =>
      array (
        'name' => 'include_option_labels',
        'argument_name' => 'include_option_labels',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When provided with a \'true\' value, single option and multiple option custom fields values contain objects in the form of \'{ id: number, label: string }\' instead of plain id',
      ),
      15 =>
      array (
        'name' => 'include_labels',
        'argument_name' => 'include_labels',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When provided with \'true\' value, response will include an array of label objects in the form of \'{ id: number, label: string }\'',
      ),
      16 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      17 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_list_organizations' =>
  array (
    'slug' => 'pipedrive_list_organizations',
    'class' => 'PipedriveListOrganizations',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/organizations',
    'api_version' => 'v2',
    'operation_id' => 'getOrganizations',
    'name' => 'Get all organizations',
    'description' => 'Get all organizations Returns data about all organizations.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only organizations matching the specified filter are returned',
      ),
      1 =>
      array (
        'name' => 'ids',
        'argument_name' => 'ids',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of up to 100 entity ids to fetch. If filter_id is provided, this is ignored. If any of the requested entities do not exist or are not visible, they are not included in the response.',
      ),
      2 =>
      array (
        'name' => 'owner_id',
        'argument_name' => 'owner_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only organizations owned by the specified user are returned. If filter_id is provided, this is ignored.',
      ),
      3 =>
      array (
        'name' => 'updated_since',
        'argument_name' => 'updated_since',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If set, only organizations with an `update_time` later than or equal to this time are returned. In RFC3339 format, e.g. 2025-01-01T10:20:00Z.',
      ),
      4 =>
      array (
        'name' => 'updated_until',
        'argument_name' => 'updated_until',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If set, only organizations with an `update_time` earlier than this time are returned. In RFC3339 format, e.g. 2025-01-01T10:20:00Z.',
      ),
      5 =>
      array (
        'name' => 'sort_by',
        'argument_name' => 'sort_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field to sort by. Supported fields: `id`, `update_time`, `add_time`.',
        'enum' =>
        array (
          0 => 'id',
          1 => 'update_time',
          2 => 'add_time',
        ),
      ),
      6 =>
      array (
        'name' => 'sort_direction',
        'argument_name' => 'sort_direction',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The sorting direction. Supported values: `asc`, `desc`.',
        'enum' =>
        array (
          0 => 'asc',
          1 => 'desc',
        ),
      ),
      7 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional fields to include',
        'enum' =>
        array (
          0 => 'next_activity_id',
          1 => 'last_activity_id',
          2 => 'open_deals_count',
          3 => 'related_open_deals_count',
          4 => 'closed_deals_count',
          5 => 'related_closed_deals_count',
          6 => 'email_messages_count',
          7 => 'people_count',
          8 => 'activities_count',
          9 => 'done_activities_count',
          10 => 'undone_activities_count',
          11 => 'files_count',
          12 => 'notes_count',
          13 => 'followers_count',
          14 => 'won_deals_count',
          15 => 'related_won_deals_count',
          16 => 'lost_deals_count',
          17 => 'related_lost_deals_count',
          18 => 'smart_bcc_email',
        ),
      ),
      8 =>
      array (
        'name' => 'custom_fields',
        'argument_name' => 'custom_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of custom fields keys to include. If you are only interested in a particular set of custom fields, please use this parameter for faster results and smaller response.<br/>A maximum of 15 keys is allowed.',
      ),
      9 =>
      array (
        'name' => 'include_option_labels',
        'argument_name' => 'include_option_labels',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When provided with a \'true\' value, single option and multiple option custom fields values contain objects in the form of \'{ id: number, label: string }\' instead of plain id',
      ),
      10 =>
      array (
        'name' => 'include_labels',
        'argument_name' => 'include_labels',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When provided with \'true\' value, response will include an array of label objects in the form of \'{ id: number, label: string }\'',
      ),
      11 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      12 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_list_persons' =>
  array (
    'slug' => 'pipedrive_list_persons',
    'class' => 'PipedriveListPersons',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/persons',
    'api_version' => 'v2',
    'operation_id' => 'getPersons',
    'name' => 'Get all persons',
    'description' => 'Get all persons Returns data about all persons. Fields `ims`, `postal_address`, `notes`, `birthday`, and `job_title` are only included if contact sync is enabled for the company.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only persons matching the specified filter are returned',
      ),
      1 =>
      array (
        'name' => 'ids',
        'argument_name' => 'ids',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of up to 100 entity ids to fetch. If filter_id is provided, this is ignored. If any of the requested entities do not exist or are not visible, they are not included in the response.',
      ),
      2 =>
      array (
        'name' => 'owner_id',
        'argument_name' => 'owner_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only persons owned by the specified user are returned. If filter_id is provided, this is ignored.',
      ),
      3 =>
      array (
        'name' => 'org_id',
        'argument_name' => 'org_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only persons linked to the specified organization are returned. If filter_id is provided, this is ignored.',
      ),
      4 =>
      array (
        'name' => 'deal_id',
        'argument_name' => 'deal_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only persons linked to the specified deal are returned. If filter_id is provided, this is ignored.',
      ),
      5 =>
      array (
        'name' => 'updated_since',
        'argument_name' => 'updated_since',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If set, only persons with an `update_time` later than or equal to this time are returned. In RFC3339 format, e.g. 2025-01-01T10:20:00Z.',
      ),
      6 =>
      array (
        'name' => 'updated_until',
        'argument_name' => 'updated_until',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If set, only persons with an `update_time` earlier than this time are returned. In RFC3339 format, e.g. 2025-01-01T10:20:00Z.',
      ),
      7 =>
      array (
        'name' => 'sort_by',
        'argument_name' => 'sort_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field to sort by. Supported fields: `id`, `update_time`, `add_time`.',
        'enum' =>
        array (
          0 => 'id',
          1 => 'update_time',
          2 => 'add_time',
        ),
      ),
      8 =>
      array (
        'name' => 'sort_direction',
        'argument_name' => 'sort_direction',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The sorting direction. Supported values: `asc`, `desc`.',
        'enum' =>
        array (
          0 => 'asc',
          1 => 'desc',
        ),
      ),
      9 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional fields to include. `marketing_status` and `doi_status` can only be included if the company has marketing app enabled.',
        'enum' =>
        array (
          0 => 'next_activity_id',
          1 => 'last_activity_id',
          2 => 'open_deals_count',
          3 => 'related_open_deals_count',
          4 => 'closed_deals_count',
          5 => 'related_closed_deals_count',
          6 => 'participant_open_deals_count',
          7 => 'participant_closed_deals_count',
          8 => 'email_messages_count',
          9 => 'activities_count',
          10 => 'done_activities_count',
          11 => 'undone_activities_count',
          12 => 'files_count',
          13 => 'notes_count',
          14 => 'followers_count',
          15 => 'won_deals_count',
          16 => 'related_won_deals_count',
          17 => 'lost_deals_count',
          18 => 'related_lost_deals_count',
          19 => 'last_incoming_mail_time',
          20 => 'last_outgoing_mail_time',
          21 => 'marketing_status',
          22 => 'doi_status',
          23 => 'smart_bcc_email',
        ),
      ),
      10 =>
      array (
        'name' => 'custom_fields',
        'argument_name' => 'custom_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of custom fields keys to include. If you are only interested in a particular set of custom fields, please use this parameter for faster results and smaller response.<br/>A maximum of 15 keys is allowed.',
      ),
      11 =>
      array (
        'name' => 'include_option_labels',
        'argument_name' => 'include_option_labels',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When provided with a \'true\' value, single option and multiple option custom fields values contain objects in the form of \'{ id: number, label: string }\' instead of plain id',
      ),
      12 =>
      array (
        'name' => 'include_labels',
        'argument_name' => 'include_labels',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When provided with \'true\' value, response will include an array of label objects in the form of \'{ id: number, label: string }\'',
      ),
      13 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      14 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_list_pipelines' =>
  array (
    'slug' => 'pipedrive_list_pipelines',
    'class' => 'PipedriveListPipelines',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/pipelines',
    'api_version' => 'v2',
    'operation_id' => 'getPipelines',
    'name' => 'Get all pipelines',
    'description' => 'Get all pipelines Returns data about all pipelines.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'sort_by',
        'argument_name' => 'sort_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field to sort by. Supported fields: `id`, `update_time`, `add_time`.',
        'enum' =>
        array (
          0 => 'id',
          1 => 'update_time',
          2 => 'add_time',
        ),
      ),
      1 =>
      array (
        'name' => 'sort_direction',
        'argument_name' => 'sort_direction',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The sorting direction. Supported values: `asc`, `desc`.',
        'enum' =>
        array (
          0 => 'asc',
          1 => 'desc',
        ),
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      3 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_list_stages' =>
  array (
    'slug' => 'pipedrive_list_stages',
    'class' => 'PipedriveListStages',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/stages',
    'api_version' => 'v2',
    'operation_id' => 'getStages',
    'name' => 'Get all stages',
    'description' => 'Get all stages Returns data about all stages.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'pipeline_id',
        'argument_name' => 'pipeline_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the pipeline to fetch stages for. If omitted, stages for all pipelines will be fetched.',
      ),
      1 =>
      array (
        'name' => 'sort_by',
        'argument_name' => 'sort_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field to sort by. Supported fields: `id`, `update_time`, `add_time`, `order_nr`.',
        'enum' =>
        array (
          0 => 'id',
          1 => 'update_time',
          2 => 'add_time',
          3 => 'order_nr',
        ),
      ),
      2 =>
      array (
        'name' => 'sort_direction',
        'argument_name' => 'sort_direction',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The sorting direction. Supported values: `asc`, `desc`.',
        'enum' =>
        array (
          0 => 'asc',
          1 => 'desc',
        ),
      ),
      3 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      4 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_merge_deals' =>
  array (
    'slug' => 'pipedrive_merge_deals',
    'class' => 'PipedriveMergeDeals',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/deals/{id}/merge',
    'api_version' => 'v1',
    'operation_id' => 'mergeDeals',
    'name' => 'Merge two deals',
    'description' => 'Merge two deals Merges a deal with another deal. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/merging-two-deals" target="_blank" rel="noopener noreferrer">merging two deals</a>.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_merge_organizations' =>
  array (
    'slug' => 'pipedrive_merge_organizations',
    'class' => 'PipedriveMergeOrganizations',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/organizations/{id}/merge',
    'api_version' => 'v1',
    'operation_id' => 'mergeOrganizations',
    'name' => 'Merge two organizations',
    'description' => 'Merge two organizations Merges an organization with another organization. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/merging-two-organizations" target="_blank" rel="noopener noreferrer">merging two organizations</a>.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_merge_persons' =>
  array (
    'slug' => 'pipedrive_merge_persons',
    'class' => 'PipedriveMergePersons',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/persons/{id}/merge',
    'api_version' => 'v1',
    'operation_id' => 'mergePersons',
    'name' => 'Merge two persons',
    'description' => 'Merge two persons Merges a person with another person. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/merging-two-persons" target="_blank" rel="noopener noreferrer">merging two persons</a>.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_put_project_plan_activity' =>
  array (
    'slug' => 'pipedrive_put_project_plan_activity',
    'class' => 'PipedrivePutProjectPlanActivity',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/projects/{id}/plan/activities/{activityId}',
    'api_version' => 'v1',
    'operation_id' => 'putProjectPlanActivity',
    'name' => 'Update activity in project plan',
    'description' => 'Update activity in project plan Updates an activity phase or group in a project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
      1 =>
      array (
        'name' => 'activityId',
        'argument_name' => 'activity_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the activity',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_put_project_plan_task' =>
  array (
    'slug' => 'pipedrive_put_project_plan_task',
    'class' => 'PipedrivePutProjectPlanTask',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/projects/{id}/plan/tasks/{taskId}',
    'api_version' => 'v1',
    'operation_id' => 'putProjectPlanTask',
    'name' => 'Update task in project plan',
    'description' => 'Update task in project plan Updates a task phase or group in a project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
      1 =>
      array (
        'name' => 'taskId',
        'argument_name' => 'task_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the task',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_receive_message' =>
  array (
    'slug' => 'pipedrive_receive_message',
    'class' => 'PipedriveReceiveMessage',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/channels/messages/receive',
    'api_version' => 'v1',
    'operation_id' => 'receiveMessage',
    'name' => 'Receives an incoming message',
    'description' => 'Receives an incoming message Adds a message to a conversation. To use the endpoint, you need to have **Messengers integration** OAuth scope enabled and the Messaging manifest ready for the [Messaging app extension](https://pipedrive.readme.io/docs/messaging-app-extension).',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_refresh_tokens' =>
  array (
    'slug' => 'pipedrive_refresh_tokens',
    'class' => 'PipedriveRefreshTokens',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/oauth/token/',
    'api_version' => 'v1',
    'operation_id' => 'refresh-tokens',
    'name' => 'Refreshing the tokens',
    'description' => 'Refreshing the tokens The `access_token` has a lifetime. After a period of time, which was returned to you in `expires_in` JSON property, the `access_token` will be invalid, and you can no longer use it to get data from our API. To refresh the `access_token`, you must use the `refresh_token`.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'Authorization',
        'argument_name' => 'authorization',
        'in' => 'header',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Base 64 encoded string containing the `client_id` and `client_secret` values. The header value should be `Basic <base64(client_id:client_secret)>`.',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_save_user_provider_link' =>
  array (
    'slug' => 'pipedrive_save_user_provider_link',
    'class' => 'PipedriveSaveUserProviderLink',
    'method' => 'POST',
    'base_path' => '/v1',
    'path' => '/meetings/userProviderLinks',
    'api_version' => 'v1',
    'operation_id' => 'saveUserProviderLink',
    'name' => 'Link a user with the installed video call integration',
    'description' => 'Link a user with the installed video call integration A video calling provider must call this endpoint after a user has installed the video calling app so that the new user\'s information is sent.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_search_leads' =>
  array (
    'slug' => 'pipedrive_search_leads',
    'class' => 'PipedriveSearchLeads',
    'method' => 'GET',
    'base_path' => '/v1',
    'path' => '/leads/search',
    'api_version' => 'v1',
    'operation_id' => 'searchLeads',
    'name' => 'Search leads',
    'description' => 'Search leads Searches all leads by title, notes and/or custom fields. This endpoint is a wrapper of <a href="https://developers.pipedrive.com/docs/api/v1/ItemSearch#searchItem">/v1/itemSearch</a> with a narrower OAuth scope. Found leads can be filtered by the person ID and the organization ID.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'term',
        'argument_name' => 'term',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The search term to look for. Minimum 2 characters (or 1 if using `exact_match`). Please note that the search term has to be URL encoded.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'argument_name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A comma-separated string array. The fields to perform the search from. Defaults to all of them.',
        'enum' =>
        array (
          0 => 'custom_fields',
          1 => 'notes',
          2 => 'title',
        ),
      ),
      2 =>
      array (
        'name' => 'exact_match',
        'argument_name' => 'exact_match',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When enabled, only full exact matches against the given term are returned. It is <b>not</b> case sensitive.',
      ),
      3 =>
      array (
        'name' => 'person_id',
        'argument_name' => 'person_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Will filter leads by the provided person ID. The upper limit of found leads associated with the person is 2000.',
      ),
      4 =>
      array (
        'name' => 'organization_id',
        'argument_name' => 'organization_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Will filter leads by the provided organization ID. The upper limit of found leads associated with the organization is 2000.',
      ),
      5 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Supports including optional fields in the results which are not provided by default',
        'enum' =>
        array (
          0 => 'lead.was_seen',
        ),
      ),
      6 =>
      array (
        'name' => 'start',
        'argument_name' => 'start',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Pagination start. Note that the pagination is based on main results and does not include related items when using `search_for_related_items` parameter.',
      ),
      7 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Items shown per page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_search_organizations' =>
  array (
    'slug' => 'pipedrive_search_organizations',
    'class' => 'PipedriveSearchOrganizations',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/organizations/search',
    'api_version' => 'v2',
    'operation_id' => 'searchOrganization',
    'name' => 'Search organizations',
    'description' => 'Search organizations Searches all organizations by name, address, notes and/or custom fields. This endpoint is a wrapper of <a href="https://developers.pipedrive.com/docs/api/v1/ItemSearch#searchItem">/v1/itemSearch</a> with a narrower OAuth scope.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'term',
        'argument_name' => 'term',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The search term to look for. Minimum 2 characters (or 1 if using `exact_match`). Please note that the search term has to be URL encoded.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'argument_name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A comma-separated string array. The fields to perform the search from. Defaults to all of them. Only the following custom field types are searchable: `address`, `varchar`, `text`, `varchar_auto`, `double`, `monetary` and `phone`. Read more about searching by custom fields <a href="https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields" target="_blank" rel="noopener noreferrer">here</a>.',
        'enum' =>
        array (
          0 => 'address',
          1 => 'custom_fields',
          2 => 'notes',
          3 => 'name',
        ),
      ),
      2 =>
      array (
        'name' => 'exact_match',
        'argument_name' => 'exact_match',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When enabled, only full exact matches against the given term are returned. It is <b>not</b> case sensitive.',
      ),
      3 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      4 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_search_persons' =>
  array (
    'slug' => 'pipedrive_search_persons',
    'class' => 'PipedriveSearchPersons',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/persons/search',
    'api_version' => 'v2',
    'operation_id' => 'searchPersons',
    'name' => 'Search persons',
    'description' => 'Search persons Searches all persons by name, email, phone, notes and/or custom fields. This endpoint is a wrapper of <a href="https://developers.pipedrive.com/docs/api/v1/ItemSearch#searchItem">/v1/itemSearch</a> with a narrower OAuth scope. Found persons can be filtered by organization ID.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'term',
        'argument_name' => 'term',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The search term to look for. Minimum 2 characters (or 1 if using `exact_match`). Please note that the search term has to be URL encoded.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'argument_name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A comma-separated string array. The fields to perform the search from. Defaults to all of them. Only the following custom field types are searchable: `address`, `varchar`, `text`, `varchar_auto`, `double`, `monetary` and `phone`. Read more about searching by custom fields <a href="https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields" target="_blank" rel="noopener noreferrer">here</a>.',
        'enum' =>
        array (
          0 => 'custom_fields',
          1 => 'email',
          2 => 'notes',
          3 => 'phone',
          4 => 'name',
        ),
      ),
      2 =>
      array (
        'name' => 'exact_match',
        'argument_name' => 'exact_match',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When enabled, only full exact matches against the given term are returned. It is <b>not</b> case sensitive.',
      ),
      3 =>
      array (
        'name' => 'organization_id',
        'argument_name' => 'organization_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Will filter persons by the provided organization ID. The upper limit of found persons associated with the organization is 2000.',
      ),
      4 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Supports including optional fields in the results which are not provided by default',
        'enum' =>
        array (
          0 => 'person.picture',
        ),
      ),
      5 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      6 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_update_activity_type' =>
  array (
    'slug' => 'pipedrive_update_activity_type',
    'class' => 'PipedriveUpdateActivityType',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/activityTypes/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateActivityType',
    'name' => 'Update an activity type',
    'description' => 'Update an activity type Updates an activity type.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the activity type',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_comment_for_note' =>
  array (
    'slug' => 'pipedrive_update_comment_for_note',
    'class' => 'PipedriveUpdateCommentForNote',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/notes/{id}/comments/{commentId}',
    'api_version' => 'v1',
    'operation_id' => 'updateCommentForNote',
    'name' => 'Update a comment related to a note',
    'description' => 'Update a comment related to a note Updates a comment related to a note.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the note',
      ),
      1 =>
      array (
        'name' => 'commentId',
        'argument_name' => 'comment_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the comment',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_deal' =>
  array (
    'slug' => 'pipedrive_update_deal',
    'class' => 'PipedriveUpdateDeal',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}',
    'api_version' => 'v2',
    'operation_id' => 'updateDeal',
    'name' => 'Update a deal',
    'description' => 'Update a deal Updates the properties of a deal.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_deal_field' =>
  array (
    'slug' => 'pipedrive_update_deal_field',
    'class' => 'PipedriveUpdateDealField',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/dealFields/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateDealField',
    'name' => 'Update a deal field',
    'description' => 'Update a deal field Updates a deal field. For more information, see the tutorial for <a href=" https://pipedrive.readme.io/docs/updating-custom-field-value " target="_blank" rel="noopener noreferrer">updating custom fields\' values</a>.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_file' =>
  array (
    'slug' => 'pipedrive_update_file',
    'class' => 'PipedriveUpdateFile',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/files/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateFile',
    'name' => 'Update file details',
    'description' => 'Update file details Updates the properties of a file.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the file',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_filter' =>
  array (
    'slug' => 'pipedrive_update_filter',
    'class' => 'PipedriveUpdateFilter',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/filters/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateFilter',
    'name' => 'Update filter',
    'description' => 'Update filter Updates an existing filter.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the filter',
      ),
      1 =>
      array (
        'name' => 'include_field_code',
        'argument_name' => 'include_field_code',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'If set to `true`, each condition in the response includes a `field_code` field identifying the field by its code name',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_goal' =>
  array (
    'slug' => 'pipedrive_update_goal',
    'class' => 'PipedriveUpdateGoal',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/goals/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateGoal',
    'name' => 'Update existing goal',
    'description' => 'Update existing goal Updates an existing goal.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the goal',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_lead' =>
  array (
    'slug' => 'pipedrive_update_lead',
    'class' => 'PipedriveUpdateLead',
    'method' => 'PATCH',
    'base_path' => '/v1',
    'path' => '/leads/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateLead',
    'name' => 'Update a lead',
    'description' => 'Update a lead Updates one or more properties of a lead. Only properties included in the request will be updated. Send `null` to unset a property (applicable for example for `value`, `person_id` or `organization_id`). If a lead contains custom fields, the fields\' values will be included in the response in the same format as with the `Deals` endpoints. If a custom field\'s value hasn\'t been set for the lead, it won\'t appear in the response. Please note that leads do not have a separate set of custom fields, instead they inherit the custom fields\' structure from deals. See an example given in the <a href="https://pipedrive.readme.io/docs/updating-custom-field-value" target="_blank" rel="noopener noreferrer">updating custom fields\' values tutorial</a>.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the lead',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_lead_label' =>
  array (
    'slug' => 'pipedrive_update_lead_label',
    'class' => 'PipedriveUpdateLeadLabel',
    'method' => 'PATCH',
    'base_path' => '/v1',
    'path' => '/leadLabels/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateLeadLabel',
    'name' => 'Update a lead label',
    'description' => 'Update a lead label Updates one or more properties of a lead label. Only properties included in the request will be updated.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the lead label',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_mail_thread_details' =>
  array (
    'slug' => 'pipedrive_update_mail_thread_details',
    'class' => 'PipedriveUpdateMailThreadDetails',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/mailbox/mailThreads/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateMailThreadDetails',
    'name' => 'Update mail thread details',
    'description' => 'Update mail thread details Updates the properties of a mail thread.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the mail thread',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_note' =>
  array (
    'slug' => 'pipedrive_update_note',
    'class' => 'PipedriveUpdateNote',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/notes/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateNote',
    'name' => 'Update a note',
    'description' => 'Update a note Updates a note.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the note',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_organization' =>
  array (
    'slug' => 'pipedrive_update_organization',
    'class' => 'PipedriveUpdateOrganization',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/organizations/{id}',
    'api_version' => 'v2',
    'operation_id' => 'updateOrganization',
    'name' => 'Update a organization',
    'description' => 'Update a organization Updates the properties of a organization.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_organization_field' =>
  array (
    'slug' => 'pipedrive_update_organization_field',
    'class' => 'PipedriveUpdateOrganizationField',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/organizationFields/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateOrganizationField',
    'name' => 'Update an organization field',
    'description' => 'Update an organization field Updates an organization field. For more information, see the tutorial for <a href=" https://pipedrive.readme.io/docs/updating-custom-field-value " target="_blank" rel="noopener noreferrer">updating custom fields\' values</a>.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_organization_relationship' =>
  array (
    'slug' => 'pipedrive_update_organization_relationship',
    'class' => 'PipedriveUpdateOrganizationRelationship',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/organizationRelationships/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateOrganizationRelationship',
    'name' => 'Update an organization relationship',
    'description' => 'Update an organization relationship Updates and returns an organization relationship.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization relationship',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_person' =>
  array (
    'slug' => 'pipedrive_update_person',
    'class' => 'PipedriveUpdatePerson',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/persons/{id}',
    'api_version' => 'v2',
    'operation_id' => 'updatePerson',
    'name' => 'Update a person',
    'description' => 'Update a person Updates the properties of a person. <br>If the company uses the [Campaigns product](https://pipedrive.readme.io/docs/campaigns-in-pipedrive-api), then this endpoint will also accept and return the `marketing_status` field.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_person_field' =>
  array (
    'slug' => 'pipedrive_update_person_field',
    'class' => 'PipedriveUpdatePersonField',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/personFields/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updatePersonField',
    'name' => 'Update a person field',
    'description' => 'Update a person field Updates a person field. For more information, see the tutorial for <a href=" https://pipedrive.readme.io/docs/updating-custom-field-value " target="_blank" rel="noopener noreferrer">updating custom fields\' values</a>.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_product_field' =>
  array (
    'slug' => 'pipedrive_update_product_field',
    'class' => 'PipedriveUpdateProductField',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/productFields/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateProductField',
    'name' => 'Update a product field',
    'description' => 'Update a product field Updates a product field. For more information, see the tutorial for <a href=" https://pipedrive.readme.io/docs/updating-custom-field-value " target="_blank" rel="noopener noreferrer">updating custom fields\' values</a>.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product field',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_project' =>
  array (
    'slug' => 'pipedrive_update_project',
    'class' => 'PipedriveUpdateProject',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/projects/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateProject',
    'name' => 'Update a project',
    'description' => 'Update a project Updates a project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_role' =>
  array (
    'slug' => 'pipedrive_update_role',
    'class' => 'PipedriveUpdateRole',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/roles/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateRole',
    'name' => 'Update role details',
    'description' => 'Update role details Updates the parent role and/or the name of a specific role.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the role',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_role_pipelines' =>
  array (
    'slug' => 'pipedrive_update_role_pipelines',
    'class' => 'PipedriveUpdateRolePipelines',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/roles/{id}/pipelines',
    'api_version' => 'v1',
    'operation_id' => 'updateRolePipelines',
    'name' => 'Update pipeline visibility for a role',
    'description' => 'Update pipeline visibility for a role Updates the specified pipelines to be visible and/or hidden for a specific role. For more information on pipeline visibility, please refer to the <a href="https://support.pipedrive.com/en/article/visibility-groups" target="_blank" rel="noopener noreferrer">Visibility groups article</a>.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the role',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_task' =>
  array (
    'slug' => 'pipedrive_update_task',
    'class' => 'PipedriveUpdateTask',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/tasks/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateTask',
    'name' => 'Update a task',
    'description' => 'Update a task Updates a task.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the task',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_team' =>
  array (
    'slug' => 'pipedrive_update_team',
    'class' => 'PipedriveUpdateTeam',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/legacyTeams/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateTeam',
    'name' => 'Update a team',
    'description' => 'Update a team Updates an existing team and returns the updated object.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the team',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_update_user' =>
  array (
    'slug' => 'pipedrive_update_user',
    'class' => 'PipedriveUpdateUser',
    'method' => 'PUT',
    'base_path' => '/v1',
    'path' => '/users/{id}',
    'api_version' => 'v1',
    'operation_id' => 'updateUser',
    'name' => 'Update user details',
    'description' => 'Update user details Updates the properties of a user. Currently, only `active_flag` can be updated.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the user',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_activity' =>
  array (
    'slug' => 'pipedrive_v2_add_activity',
    'class' => 'PipedriveV2AddActivity',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/activities',
    'api_version' => 'v2',
    'operation_id' => 'addActivity',
    'name' => 'Add a new activity',
    'description' => 'Add a new activity Adds a new activity.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_deal_field' =>
  array (
    'slug' => 'pipedrive_v2_add_deal_field',
    'class' => 'PipedriveV2AddDealField',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/dealFields',
    'api_version' => 'v2',
    'operation_id' => 'addDealField',
    'name' => 'Create one deal field',
    'description' => 'Create one deal field Creates a new deal custom field.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_deal_field_options' =>
  array (
    'slug' => 'pipedrive_v2_add_deal_field_options',
    'class' => 'PipedriveV2AddDealFieldOptions',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/dealFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'addDealFieldOptions',
    'name' => 'Add deal field options in bulk',
    'description' => 'Add deal field options in bulk Adds new options to a deal custom field that supports options (enum or set field types). This operation is atomic - all options are added or none are added. Returns only the newly added options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_deal_follower' =>
  array (
    'slug' => 'pipedrive_v2_add_deal_follower',
    'class' => 'PipedriveV2AddDealFollower',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/followers',
    'api_version' => 'v2',
    'operation_id' => 'addDealFollower',
    'name' => 'Add a follower to a deal',
    'description' => 'Add a follower to a deal Adds a user as a follower to the deal.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_deal_product' =>
  array (
    'slug' => 'pipedrive_v2_add_deal_product',
    'class' => 'PipedriveV2AddDealProduct',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/products',
    'api_version' => 'v2',
    'operation_id' => 'addDealProduct',
    'name' => 'Add a product to a deal',
    'description' => 'Add a product to a deal Adds a product to a deal, creating a new item called a deal-product.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_many_deal_products' =>
  array (
    'slug' => 'pipedrive_v2_add_many_deal_products',
    'class' => 'PipedriveV2AddManyDealProducts',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/products/bulk',
    'api_version' => 'v2',
    'operation_id' => 'addManyDealProducts',
    'name' => 'Add multiple products to a deal',
    'description' => 'Add multiple products to a deal Adds multiple products to a deal in a single request. Maximum of 100 products allowed per request.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_organization_field' =>
  array (
    'slug' => 'pipedrive_v2_add_organization_field',
    'class' => 'PipedriveV2AddOrganizationField',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/organizationFields',
    'api_version' => 'v2',
    'operation_id' => 'addOrganizationField',
    'name' => 'Create one organization field',
    'description' => 'Create one organization field Creates a new organization custom field.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_organization_field_options' =>
  array (
    'slug' => 'pipedrive_v2_add_organization_field_options',
    'class' => 'PipedriveV2AddOrganizationFieldOptions',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/organizationFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'addOrganizationFieldOptions',
    'name' => 'Add organization field options in bulk',
    'description' => 'Add organization field options in bulk Adds new options to an organization custom field that supports options (enum or set field types). This operation is atomic - all options are added or none are added. Returns only the newly added options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_organization_follower' =>
  array (
    'slug' => 'pipedrive_v2_add_organization_follower',
    'class' => 'PipedriveV2AddOrganizationFollower',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/organizations/{id}/followers',
    'api_version' => 'v2',
    'operation_id' => 'addOrganizationFollower',
    'name' => 'Add a follower to an organization',
    'description' => 'Add a follower to an organization Adds a user as a follower to the organization.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_person_field' =>
  array (
    'slug' => 'pipedrive_v2_add_person_field',
    'class' => 'PipedriveV2AddPersonField',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/personFields',
    'api_version' => 'v2',
    'operation_id' => 'addPersonField',
    'name' => 'Create one person field',
    'description' => 'Create one person field Creates a new person custom field.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_person_field_options' =>
  array (
    'slug' => 'pipedrive_v2_add_person_field_options',
    'class' => 'PipedriveV2AddPersonFieldOptions',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/personFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'addPersonFieldOptions',
    'name' => 'Add person field options in bulk',
    'description' => 'Add person field options in bulk Adds new options to a person custom field that supports options (enum or set field types). This operation is atomic - all options are added or none are added. Returns only the newly added options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_person_follower' =>
  array (
    'slug' => 'pipedrive_v2_add_person_follower',
    'class' => 'PipedriveV2AddPersonFollower',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/persons/{id}/followers',
    'api_version' => 'v2',
    'operation_id' => 'addPersonFollower',
    'name' => 'Add a follower to a person',
    'description' => 'Add a follower to a person Adds a user as a follower to the person.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_pipeline' =>
  array (
    'slug' => 'pipedrive_v2_add_pipeline',
    'class' => 'PipedriveV2AddPipeline',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/pipelines',
    'api_version' => 'v2',
    'operation_id' => 'addPipeline',
    'name' => 'Add a new pipeline',
    'description' => 'Add a new pipeline Adds a new pipeline.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_product' =>
  array (
    'slug' => 'pipedrive_v2_add_product',
    'class' => 'PipedriveV2AddProduct',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/products',
    'api_version' => 'v2',
    'operation_id' => 'addProduct',
    'name' => 'Add a product',
    'description' => 'Add a product Adds a new product to the Products inventory. For more information, see the tutorial for <a href="https://pipedrive.readme.io/docs/adding-a-product" target="_blank" rel="noopener noreferrer">adding a product</a>.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_product_field' =>
  array (
    'slug' => 'pipedrive_v2_add_product_field',
    'class' => 'PipedriveV2AddProductField',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/productFields',
    'api_version' => 'v2',
    'operation_id' => 'addProductField',
    'name' => 'Create one product field',
    'description' => 'Create one product field Creates a new product custom field.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_product_field_options' =>
  array (
    'slug' => 'pipedrive_v2_add_product_field_options',
    'class' => 'PipedriveV2AddProductFieldOptions',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/productFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'addProductFieldOptions',
    'name' => 'Add product field options in bulk',
    'description' => 'Add product field options in bulk Adds new options to a product custom field that supports options (enum or set field types). This operation is atomic - all options are added or none are added. Returns only the newly added options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_product_follower' =>
  array (
    'slug' => 'pipedrive_v2_add_product_follower',
    'class' => 'PipedriveV2AddProductFollower',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/products/{id}/followers',
    'api_version' => 'v2',
    'operation_id' => 'addProductFollower',
    'name' => 'Add a follower to a product',
    'description' => 'Add a follower to a product Adds a user as a follower to the product.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_product_variation' =>
  array (
    'slug' => 'pipedrive_v2_add_product_variation',
    'class' => 'PipedriveV2AddProductVariation',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/products/{id}/variations',
    'api_version' => 'v2',
    'operation_id' => 'addProductVariation',
    'name' => 'Add a product variation',
    'description' => 'Add a product variation Adds a new product variation.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_project' =>
  array (
    'slug' => 'pipedrive_v2_add_project',
    'class' => 'PipedriveV2AddProject',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/projects',
    'api_version' => 'v2',
    'operation_id' => 'addProject',
    'name' => 'Add a project',
    'description' => 'Add a project Adds a new project. Custom fields should be wrapped in the `custom_fields` object.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_project_board' =>
  array (
    'slug' => 'pipedrive_v2_add_project_board',
    'class' => 'PipedriveV2AddProjectBoard',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/boards',
    'api_version' => 'v2',
    'operation_id' => 'addProjectBoard',
    'name' => 'Add a project board',
    'description' => 'Add a project board Adds a new project board.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_project_field' =>
  array (
    'slug' => 'pipedrive_v2_add_project_field',
    'class' => 'PipedriveV2AddProjectField',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/projectFields',
    'api_version' => 'v2',
    'operation_id' => 'addProjectField',
    'name' => 'Create one project field',
    'description' => 'Create one project field Creates a new project custom field.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_project_field_options' =>
  array (
    'slug' => 'pipedrive_v2_add_project_field_options',
    'class' => 'PipedriveV2AddProjectFieldOptions',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/projectFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'addProjectFieldOptions',
    'name' => 'Add project field options in bulk',
    'description' => 'Add project field options in bulk Adds new options to a project custom field that supports options (enum or set field types). This operation is atomic - all options are added or none are added. Returns only the newly added options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_project_phase' =>
  array (
    'slug' => 'pipedrive_v2_add_project_phase',
    'class' => 'PipedriveV2AddProjectPhase',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/phases',
    'api_version' => 'v2',
    'operation_id' => 'addProjectPhase',
    'name' => 'Add a project phase',
    'description' => 'Add a project phase Adds a new project phase to a board.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_stage' =>
  array (
    'slug' => 'pipedrive_v2_add_stage',
    'class' => 'PipedriveV2AddStage',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/stages',
    'api_version' => 'v2',
    'operation_id' => 'addStage',
    'name' => 'Add a new stage',
    'description' => 'Add a new stage Adds a new stage, returns the ID upon success.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_add_task' =>
  array (
    'slug' => 'pipedrive_v2_add_task',
    'class' => 'PipedriveV2AddTask',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/tasks',
    'api_version' => 'v2',
    'operation_id' => 'addTask',
    'name' => 'Add a task',
    'description' => 'Add a task Adds a new task.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_archive_project' =>
  array (
    'slug' => 'pipedrive_v2_archive_project',
    'class' => 'PipedriveV2ArchiveProject',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/projects/{id}/archive',
    'api_version' => 'v2',
    'operation_id' => 'archiveProject',
    'name' => 'Archive a project',
    'description' => 'Archive a project Archives a project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_convert_deal_to_lead' =>
  array (
    'slug' => 'pipedrive_v2_convert_deal_to_lead',
    'class' => 'PipedriveV2ConvertDealToLead',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/convert/lead',
    'api_version' => 'v2',
    'operation_id' => 'convertDealToLead',
    'name' => 'Convert a deal to a lead',
    'description' => 'Convert a deal to a lead Initiates a conversion of a deal to a lead. The return value is an ID of a job that was assigned to perform the conversion. Related entities (notes, files, emails, activities, ...) are transferred during the process to the target entity. There are exceptions for entities like invoices or history that are not transferred and remain linked to the original deal. If the conversion is successful, the deal is marked as deleted. To retrieve the created entity ID and the result of the conversion, call the <a href="https://developers.pipedrive.com/docs/api/v1/Deals#getDealConversionStatus">/api/v2/deals/{deal_id}/convert/status/{conversion_id}</a> endpoint.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal to convert',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_convert_lead_to_deal' =>
  array (
    'slug' => 'pipedrive_v2_convert_lead_to_deal',
    'class' => 'PipedriveV2ConvertLeadToDeal',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/leads/{id}/convert/deal',
    'api_version' => 'v2',
    'operation_id' => 'convertLeadToDeal',
    'name' => 'Convert a lead to a deal',
    'description' => 'Convert a lead to a deal Initiates a conversion of a lead to a deal. The return value is an ID of a job that was assigned to perform the conversion. Related entities (notes, files, emails, activities, ...) are transferred during the process to the target entity. If the conversion is successful, the lead is marked as deleted. To retrieve the created entity ID and the result of the conversion, call the <a href="https://developers.pipedrive.com/docs/api/v1/Leads#getLeadConversionStatus">/api/v2/leads/{lead_id}/convert/status/{conversion_id}</a> endpoint.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the lead to convert',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_delete_activity' =>
  array (
    'slug' => 'pipedrive_v2_delete_activity',
    'class' => 'PipedriveV2DeleteActivity',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/activities/{id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteActivity',
    'name' => 'Delete an activity',
    'description' => 'Delete an activity Marks an activity as deleted. After 30 days, the activity will be permanently deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the activity',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_additional_discount' =>
  array (
    'slug' => 'pipedrive_v2_delete_additional_discount',
    'class' => 'PipedriveV2DeleteAdditionalDiscount',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/discounts/{discount_id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteAdditionalDiscount',
    'name' => 'Delete a discount from a deal',
    'description' => 'Delete a discount from a deal Removes a discount from a deal, changing the deal value if the deal has one-time products attached.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'discount_id',
        'argument_name' => 'discount_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the discount',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_deal' =>
  array (
    'slug' => 'pipedrive_v2_delete_deal',
    'class' => 'PipedriveV2DeleteDeal',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteDeal',
    'name' => 'Delete a deal',
    'description' => 'Delete a deal Marks a deal as deleted. After 30 days, the deal will be permanently deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_deal_field' =>
  array (
    'slug' => 'pipedrive_v2_delete_deal_field',
    'class' => 'PipedriveV2DeleteDealField',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/dealFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'deleteDealField',
    'name' => 'Delete one deal field',
    'description' => 'Delete one deal field Marks a custom field as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_deal_field_options' =>
  array (
    'slug' => 'pipedrive_v2_delete_deal_field_options',
    'class' => 'PipedriveV2DeleteDealFieldOptions',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/dealFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'deleteDealFieldOptions',
    'name' => 'Delete deal field options in bulk',
    'description' => 'Delete deal field options in bulk Removes existing options from a deal custom field. This operation is atomic and fails if any of the specified option IDs do not exist. Returns only the deleted options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_delete_deal_follower' =>
  array (
    'slug' => 'pipedrive_v2_delete_deal_follower',
    'class' => 'PipedriveV2DeleteDealFollower',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/followers/{follower_id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteDealFollower',
    'name' => 'Delete a follower from a deal',
    'description' => 'Delete a follower from a deal Deletes a user follower from the deal.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'follower_id',
        'argument_name' => 'follower_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the following user',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_deal_product' =>
  array (
    'slug' => 'pipedrive_v2_delete_deal_product',
    'class' => 'PipedriveV2DeleteDealProduct',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/products/{product_attachment_id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteDealProduct',
    'name' => 'Delete an attached product from a deal',
    'description' => 'Delete an attached product from a deal Deletes a product attachment from a deal, using the `product_attachment_id`.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'product_attachment_id',
        'argument_name' => 'product_attachment_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The product attachment ID',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_installment' =>
  array (
    'slug' => 'pipedrive_v2_delete_installment',
    'class' => 'PipedriveV2DeleteInstallment',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/installments/{installment_id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteInstallment',
    'name' => 'Delete an installment from a deal',
    'description' => 'Delete an installment from a deal Removes an installment from a deal. Only available in Growth and above plans.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'installment_id',
        'argument_name' => 'installment_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the installment',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_many_deal_products' =>
  array (
    'slug' => 'pipedrive_v2_delete_many_deal_products',
    'class' => 'PipedriveV2DeleteManyDealProducts',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/products',
    'api_version' => 'v2',
    'operation_id' => 'deleteManyDealProducts',
    'name' => 'Delete many products from a deal',
    'description' => 'Delete many products from a deal Deletes multiple products from a deal. If no product IDs are specified, up to 100 products will be removed from the deal. A maximum of 100 product IDs can be provided per request.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'ids',
        'argument_name' => 'ids',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Comma-separated list of deal product IDs to delete. If not provided, all deal products will be deleted up to 100 items. Maximum 100 IDs allowed.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_organization' =>
  array (
    'slug' => 'pipedrive_v2_delete_organization',
    'class' => 'PipedriveV2DeleteOrganization',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/organizations/{id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteOrganization',
    'name' => 'Delete a organization',
    'description' => 'Delete a organization Marks a organization as deleted. After 30 days, the organization will be permanently deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_organization_field' =>
  array (
    'slug' => 'pipedrive_v2_delete_organization_field',
    'class' => 'PipedriveV2DeleteOrganizationField',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/organizationFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'deleteOrganizationField',
    'name' => 'Delete one organization field',
    'description' => 'Delete one organization field Marks a custom field as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_organization_field_options' =>
  array (
    'slug' => 'pipedrive_v2_delete_organization_field_options',
    'class' => 'PipedriveV2DeleteOrganizationFieldOptions',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/organizationFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'deleteOrganizationFieldOptions',
    'name' => 'Delete organization field options in bulk',
    'description' => 'Delete organization field options in bulk Removes existing options from an organization custom field. This operation is atomic and fails if any of the specified option IDs do not exist. Returns only the deleted options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_delete_organization_follower' =>
  array (
    'slug' => 'pipedrive_v2_delete_organization_follower',
    'class' => 'PipedriveV2DeleteOrganizationFollower',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/organizations/{id}/followers/{follower_id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteOrganizationFollower',
    'name' => 'Delete a follower from an organization',
    'description' => 'Delete a follower from an organization Deletes a user follower from the organization.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
      1 =>
      array (
        'name' => 'follower_id',
        'argument_name' => 'follower_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the following user',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_person' =>
  array (
    'slug' => 'pipedrive_v2_delete_person',
    'class' => 'PipedriveV2DeletePerson',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/persons/{id}',
    'api_version' => 'v2',
    'operation_id' => 'deletePerson',
    'name' => 'Delete a person',
    'description' => 'Delete a person Marks a person as deleted. After 30 days, the person will be permanently deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_person_field' =>
  array (
    'slug' => 'pipedrive_v2_delete_person_field',
    'class' => 'PipedriveV2DeletePersonField',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/personFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'deletePersonField',
    'name' => 'Delete one person field',
    'description' => 'Delete one person field Marks a custom field as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_person_field_options' =>
  array (
    'slug' => 'pipedrive_v2_delete_person_field_options',
    'class' => 'PipedriveV2DeletePersonFieldOptions',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/personFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'deletePersonFieldOptions',
    'name' => 'Delete person field options in bulk',
    'description' => 'Delete person field options in bulk Removes existing options from a person custom field. This operation is atomic and fails if any of the specified option IDs do not exist. Returns only the deleted options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_delete_person_follower' =>
  array (
    'slug' => 'pipedrive_v2_delete_person_follower',
    'class' => 'PipedriveV2DeletePersonFollower',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/persons/{id}/followers/{follower_id}',
    'api_version' => 'v2',
    'operation_id' => 'deletePersonFollower',
    'name' => 'Delete a follower from a person',
    'description' => 'Delete a follower from a person Deletes a user follower from the person.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
      1 =>
      array (
        'name' => 'follower_id',
        'argument_name' => 'follower_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the following user',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_pipeline' =>
  array (
    'slug' => 'pipedrive_v2_delete_pipeline',
    'class' => 'PipedriveV2DeletePipeline',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/pipelines/{id}',
    'api_version' => 'v2',
    'operation_id' => 'deletePipeline',
    'name' => 'Delete a pipeline',
    'description' => 'Delete a pipeline Marks a pipeline as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the pipeline',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_product' =>
  array (
    'slug' => 'pipedrive_v2_delete_product',
    'class' => 'PipedriveV2DeleteProduct',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/products/{id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteProduct',
    'name' => 'Delete a product',
    'description' => 'Delete a product Marks a product as deleted. After 30 days, the product will be permanently deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_product_field' =>
  array (
    'slug' => 'pipedrive_v2_delete_product_field',
    'class' => 'PipedriveV2DeleteProductField',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/productFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'deleteProductField',
    'name' => 'Delete one product field',
    'description' => 'Delete one product field Marks a custom field as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_product_field_options' =>
  array (
    'slug' => 'pipedrive_v2_delete_product_field_options',
    'class' => 'PipedriveV2DeleteProductFieldOptions',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/productFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'deleteProductFieldOptions',
    'name' => 'Delete product field options in bulk',
    'description' => 'Delete product field options in bulk Removes existing options from a product custom field. This operation is atomic and fails if any of the specified option IDs do not exist. Returns only the deleted options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_delete_product_follower' =>
  array (
    'slug' => 'pipedrive_v2_delete_product_follower',
    'class' => 'PipedriveV2DeleteProductFollower',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/products/{id}/followers/{follower_id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteProductFollower',
    'name' => 'Delete a follower from a product',
    'description' => 'Delete a follower from a product Deletes a user follower from the product.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
      1 =>
      array (
        'name' => 'follower_id',
        'argument_name' => 'follower_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the following user',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_product_image' =>
  array (
    'slug' => 'pipedrive_v2_delete_product_image',
    'class' => 'PipedriveV2DeleteProductImage',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/products/{id}/images',
    'api_version' => 'v2',
    'operation_id' => 'deleteProductImage',
    'name' => 'Delete an image of a product',
    'description' => 'Delete an image of a product Deletes the image of a product.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_product_variation' =>
  array (
    'slug' => 'pipedrive_v2_delete_product_variation',
    'class' => 'PipedriveV2DeleteProductVariation',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/products/{id}/variations/{product_variation_id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteProductVariation',
    'name' => 'Delete a product variation',
    'description' => 'Delete a product variation Deletes a product variation.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
      1 =>
      array (
        'name' => 'product_variation_id',
        'argument_name' => 'product_variation_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product variation',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_project' =>
  array (
    'slug' => 'pipedrive_v2_delete_project',
    'class' => 'PipedriveV2DeleteProject',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/projects/{id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteProject',
    'name' => 'Delete a project',
    'description' => 'Delete a project Marks a project as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_project_board' =>
  array (
    'slug' => 'pipedrive_v2_delete_project_board',
    'class' => 'PipedriveV2DeleteProjectBoard',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/boards/{id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteProjectBoard',
    'name' => 'Delete a project board',
    'description' => 'Delete a project board Marks a project board as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project board',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_project_field' =>
  array (
    'slug' => 'pipedrive_v2_delete_project_field',
    'class' => 'PipedriveV2DeleteProjectField',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/projectFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'deleteProjectField',
    'name' => 'Delete one project field',
    'description' => 'Delete one project field Marks a custom field as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_project_field_options' =>
  array (
    'slug' => 'pipedrive_v2_delete_project_field_options',
    'class' => 'PipedriveV2DeleteProjectFieldOptions',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/projectFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'deleteProjectFieldOptions',
    'name' => 'Delete project field options in bulk',
    'description' => 'Delete project field options in bulk Removes existing options from a project custom field. This operation is atomic and fails if any of the specified option IDs do not exist. Returns only the deleted options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_delete_project_phase' =>
  array (
    'slug' => 'pipedrive_v2_delete_project_phase',
    'class' => 'PipedriveV2DeleteProjectPhase',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/phases/{id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteProjectPhase',
    'name' => 'Delete a project phase',
    'description' => 'Delete a project phase Marks a project phase as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project phase',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_stage' =>
  array (
    'slug' => 'pipedrive_v2_delete_stage',
    'class' => 'PipedriveV2DeleteStage',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/stages/{id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteStage',
    'name' => 'Delete a stage',
    'description' => 'Delete a stage Marks a stage as deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the stage',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_delete_task' =>
  array (
    'slug' => 'pipedrive_v2_delete_task',
    'class' => 'PipedriveV2DeleteTask',
    'method' => 'DELETE',
    'base_path' => '/api/v2',
    'path' => '/tasks/{id}',
    'api_version' => 'v2',
    'operation_id' => 'deleteTask',
    'name' => 'Delete a task',
    'description' => 'Delete a task Marks a task as deleted. If the task has subtasks, those will also be deleted.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the task',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_duplicate_product' =>
  array (
    'slug' => 'pipedrive_v2_duplicate_product',
    'class' => 'PipedriveV2DuplicateProduct',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/products/{id}/duplicate',
    'api_version' => 'v2',
    'operation_id' => 'duplicateProduct',
    'name' => 'Duplicate a product',
    'description' => 'Duplicate a product Creates a duplicate of an existing product including all variations, prices, and custom fields.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_activities' =>
  array (
    'slug' => 'pipedrive_v2_get_activities',
    'class' => 'PipedriveV2GetActivities',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/activities',
    'api_version' => 'v2',
    'operation_id' => 'getActivities',
    'name' => 'Get all activities',
    'description' => 'Get all activities Returns data about all activities.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only activities matching the specified filter are returned',
      ),
      1 =>
      array (
        'name' => 'ids',
        'argument_name' => 'ids',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of up to 100 entity ids to fetch. If filter_id is provided, this is ignored. If any of the requested entities do not exist or are not visible, they are not included in the response.',
      ),
      2 =>
      array (
        'name' => 'owner_id',
        'argument_name' => 'owner_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only activities owned by the specified user are returned. If filter_id is provided, this is ignored.',
      ),
      3 =>
      array (
        'name' => 'deal_id',
        'argument_name' => 'deal_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only activities linked to the specified deal are returned. If filter_id is provided, this is ignored.',
      ),
      4 =>
      array (
        'name' => 'lead_id',
        'argument_name' => 'lead_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If supplied, only activities linked to the specified lead are returned. If filter_id is provided, this is ignored.',
      ),
      5 =>
      array (
        'name' => 'person_id',
        'argument_name' => 'person_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only activities whose primary participant is the given person are returned. If filter_id is provided, this is ignored.',
      ),
      6 =>
      array (
        'name' => 'org_id',
        'argument_name' => 'org_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only activities linked to the specified organization are returned. If filter_id is provided, this is ignored.',
      ),
      7 =>
      array (
        'name' => 'done',
        'argument_name' => 'done',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'If supplied, only activities with specified \'done\' flag value are returned',
      ),
      8 =>
      array (
        'name' => 'updated_since',
        'argument_name' => 'updated_since',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If set, only activities with an `update_time` later than or equal to this time are returned. In RFC3339 format, e.g. 2025-01-01T10:20:00Z.',
      ),
      9 =>
      array (
        'name' => 'updated_until',
        'argument_name' => 'updated_until',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If set, only activities with an `update_time` earlier than this time are returned. In RFC3339 format, e.g. 2025-01-01T10:20:00Z.',
      ),
      10 =>
      array (
        'name' => 'sort_by',
        'argument_name' => 'sort_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field to sort by. Supported fields: `id`, `update_time`, `add_time`, `due_date`.',
        'enum' =>
        array (
          0 => 'id',
          1 => 'update_time',
          2 => 'add_time',
          3 => 'due_date',
        ),
      ),
      11 =>
      array (
        'name' => 'sort_direction',
        'argument_name' => 'sort_direction',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The sorting direction. Supported values: `asc`, `desc`.',
        'enum' =>
        array (
          0 => 'asc',
          1 => 'desc',
        ),
      ),
      12 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional fields to include',
        'enum' =>
        array (
          0 => 'attendees',
        ),
      ),
      13 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      14 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_activity' =>
  array (
    'slug' => 'pipedrive_v2_get_activity',
    'class' => 'PipedriveV2GetActivity',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/activities/{id}',
    'api_version' => 'v2',
    'operation_id' => 'getActivity',
    'name' => 'Get details of an activity',
    'description' => 'Get details of an activity Returns the details of a specific activity.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the activity',
      ),
      1 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional fields to include',
        'enum' =>
        array (
          0 => 'attendees',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_activity_field' =>
  array (
    'slug' => 'pipedrive_v2_get_activity_field',
    'class' => 'PipedriveV2GetActivityField',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/activityFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'getActivityField',
    'name' => 'Get one activity field',
    'description' => 'Get one activity field Returns metadata about a specific activity field.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
      1 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional data namespaces to include in response',
        'enum' =>
        array (
          0 => 'ui_visibility',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_activity_fields' =>
  array (
    'slug' => 'pipedrive_v2_get_activity_fields',
    'class' => 'PipedriveV2GetActivityFields',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/activityFields',
    'api_version' => 'v2',
    'operation_id' => 'getActivityFields',
    'name' => 'Get all activity fields',
    'description' => 'Get all activity fields Returns metadata about all activity fields in the company.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional data namespaces to include in response',
        'enum' =>
        array (
          0 => 'ui_visibility',
        ),
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_additional_discounts' =>
  array (
    'slug' => 'pipedrive_v2_get_additional_discounts',
    'class' => 'PipedriveV2GetAdditionalDiscounts',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/discounts',
    'api_version' => 'v2',
    'operation_id' => 'getAdditionalDiscounts',
    'name' => 'List discounts added to a deal',
    'description' => 'List discounts added to a deal Lists discounts attached to a deal.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_archived_deals' =>
  array (
    'slug' => 'pipedrive_v2_get_archived_deals',
    'class' => 'PipedriveV2GetArchivedDeals',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/deals/archived',
    'api_version' => 'v2',
    'operation_id' => 'getArchivedDeals',
    'name' => 'Get all archived deals',
    'description' => 'Get all archived deals Returns data about all archived deals.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals matching the specified filter are returned',
      ),
      1 =>
      array (
        'name' => 'ids',
        'argument_name' => 'ids',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of up to 100 entity ids to fetch. If filter_id is provided, this is ignored. If any of the requested entities do not exist or are not visible, they are not included in the response.',
      ),
      2 =>
      array (
        'name' => 'owner_id',
        'argument_name' => 'owner_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals owned by the specified user are returned. If filter_id is provided, this is ignored.',
      ),
      3 =>
      array (
        'name' => 'person_id',
        'argument_name' => 'person_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals linked to the specified person are returned. If filter_id is provided, this is ignored.',
      ),
      4 =>
      array (
        'name' => 'org_id',
        'argument_name' => 'org_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals linked to the specified organization are returned. If filter_id is provided, this is ignored.',
      ),
      5 =>
      array (
        'name' => 'pipeline_id',
        'argument_name' => 'pipeline_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals in the specified pipeline are returned. If filter_id is provided, this is ignored.',
      ),
      6 =>
      array (
        'name' => 'stage_id',
        'argument_name' => 'stage_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only deals in the specified stage are returned. If filter_id is provided, this is ignored.',
      ),
      7 =>
      array (
        'name' => 'status',
        'argument_name' => 'status',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Only fetch deals with a specific status. If omitted, all not deleted deals are returned. If set to deleted, deals that have been deleted up to 30 days ago will be included. Multiple statuses can be included as a comma separated array. If filter_id is provided, this is ignored.',
        'enum' =>
        array (
          0 => 'open',
          1 => 'won',
          2 => 'lost',
          3 => 'deleted',
        ),
      ),
      8 =>
      array (
        'name' => 'updated_since',
        'argument_name' => 'updated_since',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If set, only deals with an `update_time` later than or equal to this time are returned. In RFC3339 format, e.g. 2025-01-01T10:20:00Z.',
      ),
      9 =>
      array (
        'name' => 'updated_until',
        'argument_name' => 'updated_until',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If set, only deals with an `update_time` earlier than this time are returned. In RFC3339 format, e.g. 2025-01-01T10:20:00Z.',
      ),
      10 =>
      array (
        'name' => 'sort_by',
        'argument_name' => 'sort_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field to sort by. Supported fields: `id`, `update_time`, `add_time`.',
        'enum' =>
        array (
          0 => 'id',
          1 => 'update_time',
          2 => 'add_time',
        ),
      ),
      11 =>
      array (
        'name' => 'sort_direction',
        'argument_name' => 'sort_direction',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The sorting direction. Supported values: `asc`, `desc`.',
        'enum' =>
        array (
          0 => 'asc',
          1 => 'desc',
        ),
      ),
      12 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional fields to include',
        'enum' =>
        array (
          0 => 'next_activity_id',
          1 => 'last_activity_id',
          2 => 'first_won_time',
          3 => 'products_count',
          4 => 'files_count',
          5 => 'notes_count',
          6 => 'followers_count',
          7 => 'email_messages_count',
          8 => 'activities_count',
          9 => 'done_activities_count',
          10 => 'undone_activities_count',
          11 => 'participants_count',
          12 => 'last_incoming_mail_time',
          13 => 'last_outgoing_mail_time',
          14 => 'smart_bcc_email',
          15 => 'source_lead_id',
        ),
      ),
      13 =>
      array (
        'name' => 'custom_fields',
        'argument_name' => 'custom_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of custom fields keys to include. If you are only interested in a particular set of custom fields, please use this parameter for faster results and smaller response.<br/>A maximum of 15 keys is allowed.',
      ),
      14 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      15 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_archived_projects' =>
  array (
    'slug' => 'pipedrive_v2_get_archived_projects',
    'class' => 'PipedriveV2GetArchivedProjects',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/projects/archived',
    'api_version' => 'v2',
    'operation_id' => 'getArchivedProjects',
    'name' => 'Get all archived projects',
    'description' => 'Get all archived projects Returns all archived projects.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only projects matching the specified filter are returned',
      ),
      1 =>
      array (
        'name' => 'status',
        'argument_name' => 'status',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If supplied, includes only projects with the specified statuses. Possible values are `open`, `completed`, `canceled` and `deleted`. By default `deleted` projects are not returned.',
      ),
      2 =>
      array (
        'name' => 'phase_id',
        'argument_name' => 'phase_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only projects in the specified phase are returned',
      ),
      3 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      4 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_deal_conversion_status' =>
  array (
    'slug' => 'pipedrive_v2_get_deal_conversion_status',
    'class' => 'PipedriveV2GetDealConversionStatus',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/convert/status/{conversion_id}',
    'api_version' => 'v2',
    'operation_id' => 'getDealConversionStatus',
    'name' => 'Get Deal conversion status',
    'description' => 'Get Deal conversion status Returns information about the conversion. Status is always present and its value (not_started, running, completed, failed, rejected) represents the current state of the conversion. Lead ID is only present if the conversion was successfully finished. This data is only temporary and removed after a few days.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of a deal',
      ),
      1 =>
      array (
        'name' => 'conversion_id',
        'argument_name' => 'conversion_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the conversion',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_deal_field' =>
  array (
    'slug' => 'pipedrive_v2_get_deal_field',
    'class' => 'PipedriveV2GetDealField',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/dealFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'getDealField',
    'name' => 'Get one deal field',
    'description' => 'Get one deal field Returns metadata about a specific deal field.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
      1 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional data namespaces to include in response',
        'enum' =>
        array (
          0 => 'ui_visibility',
          1 => 'important_fields',
          2 => 'required_fields',
          3 => 'ui_visibility,important_fields',
          4 => 'ui_visibility,required_fields',
          5 => 'important_fields,required_fields',
          6 => 'ui_visibility,important_fields,required_fields',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_deal_fields' =>
  array (
    'slug' => 'pipedrive_v2_get_deal_fields',
    'class' => 'PipedriveV2GetDealFields',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/dealFields',
    'api_version' => 'v2',
    'operation_id' => 'getDealFields',
    'name' => 'Get all deal fields',
    'description' => 'Get all deal fields Returns metadata about all deal fields in the company.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional data namespaces to include in response',
        'enum' =>
        array (
          0 => 'ui_visibility',
          1 => 'important_fields',
          2 => 'required_fields',
          3 => 'ui_visibility,important_fields',
          4 => 'ui_visibility,required_fields',
          5 => 'important_fields,required_fields',
          6 => 'ui_visibility,important_fields,required_fields',
        ),
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_deal_followers' =>
  array (
    'slug' => 'pipedrive_v2_get_deal_followers',
    'class' => 'PipedriveV2GetDealFollowers',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/followers',
    'api_version' => 'v2',
    'operation_id' => 'getDealFollowers',
    'name' => 'List followers of a deal',
    'description' => 'List followers of a deal Lists users who are following the deal.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_deal_followers_changelog' =>
  array (
    'slug' => 'pipedrive_v2_get_deal_followers_changelog',
    'class' => 'PipedriveV2GetDealFollowersChangelog',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/followers/changelog',
    'api_version' => 'v2',
    'operation_id' => 'getDealFollowersChangelog',
    'name' => 'List followers changelog of a deal',
    'description' => 'List followers changelog of a deal Lists changelogs about users have followed the deal.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_deal_products' =>
  array (
    'slug' => 'pipedrive_v2_get_deal_products',
    'class' => 'PipedriveV2GetDealProducts',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/products',
    'api_version' => 'v2',
    'operation_id' => 'getDealProducts',
    'name' => 'List products attached to a deal',
    'description' => 'List products attached to a deal Lists products attached to a deal.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      3 =>
      array (
        'name' => 'sort_by',
        'argument_name' => 'sort_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field to sort by. Supported fields: `id`, `add_time`, `update_time`, `order_nr`.',
        'enum' =>
        array (
          0 => 'id',
          1 => 'add_time',
          2 => 'update_time',
          3 => 'order_nr',
        ),
      ),
      4 =>
      array (
        'name' => 'sort_direction',
        'argument_name' => 'sort_direction',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The sorting direction. Supported values: `asc`, `desc`.',
        'enum' =>
        array (
          0 => 'asc',
          1 => 'desc',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_deals_products' =>
  array (
    'slug' => 'pipedrive_v2_get_deals_products',
    'class' => 'PipedriveV2GetDealsProducts',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/deals/products',
    'api_version' => 'v2',
    'operation_id' => 'getDealsProducts',
    'name' => 'Get deal products of several deals',
    'description' => 'Get deal products of several deals Returns data about products attached to deals',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'deal_ids',
        'argument_name' => 'deal_ids',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'array',
        'description' => 'An array of integers with the IDs of the deals for which the attached products will be returned. A maximum of 100 deal IDs can be provided.',
        'items' =>
        array (
          'type' => 'integer',
        ),
      ),
      1 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      3 =>
      array (
        'name' => 'sort_by',
        'argument_name' => 'sort_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field to sort by. Supported fields: `id`, `deal_id`, `add_time`, `update_time`, `order_nr`.',
        'enum' =>
        array (
          0 => 'id',
          1 => 'deal_id',
          2 => 'add_time',
          3 => 'update_time',
          4 => 'order_nr',
        ),
      ),
      4 =>
      array (
        'name' => 'sort_direction',
        'argument_name' => 'sort_direction',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The sorting direction. Supported values: `asc`, `desc`.',
        'enum' =>
        array (
          0 => 'asc',
          1 => 'desc',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_installments' =>
  array (
    'slug' => 'pipedrive_v2_get_installments',
    'class' => 'PipedriveV2GetInstallments',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/deals/installments',
    'api_version' => 'v2',
    'operation_id' => 'getInstallments',
    'name' => 'List installments added to a list of deals',
    'description' => 'List installments added to a list of deals Lists installments attached to a list of deals. Only available in Growth and above plans.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'deal_ids',
        'argument_name' => 'deal_ids',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'array',
        'description' => 'An array of integers with the IDs of the deals for which the attached installments will be returned. A maximum of 100 deal IDs can be provided.',
        'items' =>
        array (
          'type' => 'integer',
        ),
      ),
      1 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      3 =>
      array (
        'name' => 'sort_by',
        'argument_name' => 'sort_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field to sort by. Supported fields: `id`, `billing_date`, `deal_id`.',
        'enum' =>
        array (
          0 => 'id',
          1 => 'billing_date',
          2 => 'deal_id',
        ),
      ),
      4 =>
      array (
        'name' => 'sort_direction',
        'argument_name' => 'sort_direction',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The sorting direction. Supported values: `asc`, `desc`.',
        'enum' =>
        array (
          0 => 'asc',
          1 => 'desc',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_lead_conversion_status' =>
  array (
    'slug' => 'pipedrive_v2_get_lead_conversion_status',
    'class' => 'PipedriveV2GetLeadConversionStatus',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/leads/{id}/convert/status/{conversion_id}',
    'api_version' => 'v2',
    'operation_id' => 'getLeadConversionStatus',
    'name' => 'Get Lead conversion status',
    'description' => 'Get Lead conversion status Returns data about the conversion. Status is always present and its value (not_started, running, completed, failed, rejected) represents the current state of the conversion. Deal ID is only present if the conversion was successfully finished. This data is only temporary and removed after a few days.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of a lead',
      ),
      1 =>
      array (
        'name' => 'conversion_id',
        'argument_name' => 'conversion_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the conversion',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_organization_field' =>
  array (
    'slug' => 'pipedrive_v2_get_organization_field',
    'class' => 'PipedriveV2GetOrganizationField',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/organizationFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'getOrganizationField',
    'name' => 'Get one organization field',
    'description' => 'Get one organization field Returns metadata about a specific organization field.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
      1 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional data namespaces to include in response',
        'enum' =>
        array (
          0 => 'ui_visibility',
          1 => 'important_fields',
          2 => 'required_fields',
          3 => 'ui_visibility,important_fields',
          4 => 'ui_visibility,required_fields',
          5 => 'important_fields,required_fields',
          6 => 'ui_visibility,important_fields,required_fields',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_organization_fields' =>
  array (
    'slug' => 'pipedrive_v2_get_organization_fields',
    'class' => 'PipedriveV2GetOrganizationFields',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/organizationFields',
    'api_version' => 'v2',
    'operation_id' => 'getOrganizationFields',
    'name' => 'Get all organization fields',
    'description' => 'Get all organization fields Returns metadata about all organization fields in the company.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional data namespaces to include in response',
        'enum' =>
        array (
          0 => 'ui_visibility',
          1 => 'important_fields',
          2 => 'required_fields',
          3 => 'ui_visibility,important_fields',
          4 => 'ui_visibility,required_fields',
          5 => 'important_fields,required_fields',
          6 => 'ui_visibility,important_fields,required_fields',
        ),
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_organization_followers' =>
  array (
    'slug' => 'pipedrive_v2_get_organization_followers',
    'class' => 'PipedriveV2GetOrganizationFollowers',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/organizations/{id}/followers',
    'api_version' => 'v2',
    'operation_id' => 'getOrganizationFollowers',
    'name' => 'List followers of an organization',
    'description' => 'List followers of an organization Lists users who are following the organization.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_organization_followers_changelog' =>
  array (
    'slug' => 'pipedrive_v2_get_organization_followers_changelog',
    'class' => 'PipedriveV2GetOrganizationFollowersChangelog',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/organizations/{id}/followers/changelog',
    'api_version' => 'v2',
    'operation_id' => 'getOrganizationFollowersChangelog',
    'name' => 'List followers changelog of an organization',
    'description' => 'List followers changelog of an organization Lists changelogs about users have followed the organization.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the organization',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_person_field' =>
  array (
    'slug' => 'pipedrive_v2_get_person_field',
    'class' => 'PipedriveV2GetPersonField',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/personFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'getPersonField',
    'name' => 'Get one person field',
    'description' => 'Get one person field Returns metadata about a specific person field.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
      1 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional data namespaces to include in response',
        'enum' =>
        array (
          0 => 'ui_visibility',
          1 => 'important_fields',
          2 => 'required_fields',
          3 => 'ui_visibility,important_fields',
          4 => 'ui_visibility,required_fields',
          5 => 'important_fields,required_fields',
          6 => 'ui_visibility,important_fields,required_fields',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_person_fields' =>
  array (
    'slug' => 'pipedrive_v2_get_person_fields',
    'class' => 'PipedriveV2GetPersonFields',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/personFields',
    'api_version' => 'v2',
    'operation_id' => 'getPersonFields',
    'name' => 'Get all person fields',
    'description' => 'Get all person fields Returns metadata about all person fields in the company.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional data namespaces to include in response',
        'enum' =>
        array (
          0 => 'ui_visibility',
          1 => 'important_fields',
          2 => 'required_fields',
          3 => 'ui_visibility,important_fields',
          4 => 'ui_visibility,required_fields',
          5 => 'important_fields,required_fields',
          6 => 'ui_visibility,important_fields,required_fields',
        ),
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_person_followers' =>
  array (
    'slug' => 'pipedrive_v2_get_person_followers',
    'class' => 'PipedriveV2GetPersonFollowers',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/persons/{id}/followers',
    'api_version' => 'v2',
    'operation_id' => 'getPersonFollowers',
    'name' => 'List followers of a person',
    'description' => 'List followers of a person Lists users who are following the person.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_person_followers_changelog' =>
  array (
    'slug' => 'pipedrive_v2_get_person_followers_changelog',
    'class' => 'PipedriveV2GetPersonFollowersChangelog',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/persons/{id}/followers/changelog',
    'api_version' => 'v2',
    'operation_id' => 'getPersonFollowersChangelog',
    'name' => 'List followers changelog of a person',
    'description' => 'List followers changelog of a person Lists changelogs about users have followed the person.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_person_picture' =>
  array (
    'slug' => 'pipedrive_v2_get_person_picture',
    'class' => 'PipedriveV2GetPersonPicture',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/persons/{id}/picture',
    'api_version' => 'v2',
    'operation_id' => 'getPersonPicture',
    'name' => 'Get picture of a person',
    'description' => 'Get picture of a person Returns the picture associated with a person. The picture URLs include both 128x128 and 512x512 pixel versions.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the person',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_pipeline' =>
  array (
    'slug' => 'pipedrive_v2_get_pipeline',
    'class' => 'PipedriveV2GetPipeline',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/pipelines/{id}',
    'api_version' => 'v2',
    'operation_id' => 'getPipeline',
    'name' => 'Get one pipeline',
    'description' => 'Get one pipeline Returns data about a specific pipeline.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the pipeline',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_product' =>
  array (
    'slug' => 'pipedrive_v2_get_product',
    'class' => 'PipedriveV2GetProduct',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/products/{id}',
    'api_version' => 'v2',
    'operation_id' => 'getProduct',
    'name' => 'Get one product',
    'description' => 'Get one product Returns data about a specific product.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_product_field' =>
  array (
    'slug' => 'pipedrive_v2_get_product_field',
    'class' => 'PipedriveV2GetProductField',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/productFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'getProductField',
    'name' => 'Get one product field',
    'description' => 'Get one product field Returns metadata about a specific product field.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
      1 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional data namespaces to include in response',
        'enum' =>
        array (
          0 => 'ui_visibility',
        ),
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_product_fields' =>
  array (
    'slug' => 'pipedrive_v2_get_product_fields',
    'class' => 'PipedriveV2GetProductFields',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/productFields',
    'api_version' => 'v2',
    'operation_id' => 'getProductFields',
    'name' => 'Get all product fields',
    'description' => 'Get all product fields Returns metadata about all product fields in the company.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of additional data namespaces to include in response',
        'enum' =>
        array (
          0 => 'ui_visibility',
        ),
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_product_followers' =>
  array (
    'slug' => 'pipedrive_v2_get_product_followers',
    'class' => 'PipedriveV2GetProductFollowers',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/products/{id}/followers',
    'api_version' => 'v2',
    'operation_id' => 'getProductFollowers',
    'name' => 'List followers of a product',
    'description' => 'List followers of a product Lists users who are following the product.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_product_followers_changelog' =>
  array (
    'slug' => 'pipedrive_v2_get_product_followers_changelog',
    'class' => 'PipedriveV2GetProductFollowersChangelog',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/products/{id}/followers/changelog',
    'api_version' => 'v2',
    'operation_id' => 'getProductFollowersChangelog',
    'name' => 'List followers changelog of a product',
    'description' => 'List followers changelog of a product Lists changelogs about users have followed the product.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_product_image' =>
  array (
    'slug' => 'pipedrive_v2_get_product_image',
    'class' => 'PipedriveV2GetProductImage',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/products/{id}/images',
    'api_version' => 'v2',
    'operation_id' => 'getProductImage',
    'name' => 'Get image of a product',
    'description' => 'Get image of a product Retrieves the image of a product. The public URL has a limited lifetime of 7 days.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_product_variations' =>
  array (
    'slug' => 'pipedrive_v2_get_product_variations',
    'class' => 'PipedriveV2GetProductVariations',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/products/{id}/variations',
    'api_version' => 'v2',
    'operation_id' => 'getProductVariations',
    'name' => 'Get all product variations',
    'description' => 'Get all product variations Returns data about all product variations.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
      1 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
      2 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_products' =>
  array (
    'slug' => 'pipedrive_v2_get_products',
    'class' => 'PipedriveV2GetProducts',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/products',
    'api_version' => 'v2',
    'operation_id' => 'getProducts',
    'name' => 'Get all products',
    'description' => 'Get all products Returns data about all products.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'owner_id',
        'argument_name' => 'owner_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only products owned by the given user will be returned',
      ),
      1 =>
      array (
        'name' => 'ids',
        'argument_name' => 'ids',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Optional comma separated string array of up to 100 entity ids to fetch. If filter_id is provided, this is ignored. If any of the requested entities do not exist or are not visible, they are not included in the response.',
      ),
      2 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'The ID of the filter to use',
      ),
      3 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
      4 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      5 =>
      array (
        'name' => 'sort_by',
        'argument_name' => 'sort_by',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The field to sort by. Supported fields: `id`, `name`, `add_time`, `update_time`.',
        'enum' =>
        array (
          0 => 'id',
          1 => 'name',
          2 => 'add_time',
          3 => 'update_time',
        ),
      ),
      6 =>
      array (
        'name' => 'sort_direction',
        'argument_name' => 'sort_direction',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The sorting direction. Supported values: `asc`, `desc`.',
        'enum' =>
        array (
          0 => 'asc',
          1 => 'desc',
        ),
      ),
      7 =>
      array (
        'name' => 'custom_fields',
        'argument_name' => 'custom_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Comma separated string array of custom fields keys to include. If you are only interested in a particular set of custom fields, please use this parameter for a smaller response.<br/>A maximum of 15 keys is allowed.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_project' =>
  array (
    'slug' => 'pipedrive_v2_get_project',
    'class' => 'PipedriveV2GetProject',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/projects/{id}',
    'api_version' => 'v2',
    'operation_id' => 'getProject',
    'name' => 'Get details of a project',
    'description' => 'Get details of a project Returns the details of a specific project. Custom fields appear as keys inside the `custom_fields` object.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_project_changelog' =>
  array (
    'slug' => 'pipedrive_v2_get_project_changelog',
    'class' => 'PipedriveV2GetProjectChangelog',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/projects/{id}/changelog',
    'api_version' => 'v2',
    'operation_id' => 'getProjectChangelog',
    'name' => 'List updates about project field values',
    'description' => 'List updates about project field values Lists updates about field values of a project.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_project_field' =>
  array (
    'slug' => 'pipedrive_v2_get_project_field',
    'class' => 'PipedriveV2GetProjectField',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/projectFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'getProjectField',
    'name' => 'Get one project field',
    'description' => 'Get one project field Returns metadata about a specific project field.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_project_fields' =>
  array (
    'slug' => 'pipedrive_v2_get_project_fields',
    'class' => 'PipedriveV2GetProjectFields',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/projectFields',
    'api_version' => 'v2',
    'operation_id' => 'getProjectFields',
    'name' => 'Get all project fields',
    'description' => 'Get all project fields Returns metadata about all project fields in the company.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      1 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_project_template' =>
  array (
    'slug' => 'pipedrive_v2_get_project_template',
    'class' => 'PipedriveV2GetProjectTemplate',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/projectTemplates/{id}',
    'api_version' => 'v2',
    'operation_id' => 'getProjectTemplate',
    'name' => 'Get details of a template',
    'description' => 'Get details of a template Returns the details of a specific project template.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project template',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_project_templates' =>
  array (
    'slug' => 'pipedrive_v2_get_project_templates',
    'class' => 'PipedriveV2GetProjectTemplates',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/projectTemplates',
    'api_version' => 'v2',
    'operation_id' => 'getProjectTemplates',
    'name' => 'Get all project templates',
    'description' => 'Get all project templates Returns all not deleted project templates.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_project_users' =>
  array (
    'slug' => 'pipedrive_v2_get_project_users',
    'class' => 'PipedriveV2GetProjectUsers',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/projects/{id}/permittedUsers',
    'api_version' => 'v2',
    'operation_id' => 'getProjectUsers',
    'name' => 'List permitted users',
    'description' => 'List permitted users Lists the users permitted to access a project.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_projects' =>
  array (
    'slug' => 'pipedrive_v2_get_projects',
    'class' => 'PipedriveV2GetProjects',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/projects',
    'api_version' => 'v2',
    'operation_id' => 'getProjects',
    'name' => 'Get all projects',
    'description' => 'Get all projects Returns all non-archived projects.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'filter_id',
        'argument_name' => 'filter_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only projects matching the specified filter are returned',
      ),
      1 =>
      array (
        'name' => 'status',
        'argument_name' => 'status',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If supplied, includes only projects with the specified statuses. Possible values are `open`, `completed`, `canceled` and `deleted`. By default `deleted` projects are not returned.',
      ),
      2 =>
      array (
        'name' => 'phase_id',
        'argument_name' => 'phase_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only projects in the specified phase are returned',
      ),
      3 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      4 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_projects_board' =>
  array (
    'slug' => 'pipedrive_v2_get_projects_board',
    'class' => 'PipedriveV2GetProjectsBoard',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/boards/{id}',
    'api_version' => 'v2',
    'operation_id' => 'getProjectsBoard',
    'name' => 'Get details of a project board',
    'description' => 'Get details of a project board Returns the details of a specific project board.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project board',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_projects_boards' =>
  array (
    'slug' => 'pipedrive_v2_get_projects_boards',
    'class' => 'PipedriveV2GetProjectsBoards',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/boards',
    'api_version' => 'v2',
    'operation_id' => 'getProjectsBoards',
    'name' => 'Get all project boards',
    'description' => 'Get all project boards Returns all active project boards.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_projects_phase' =>
  array (
    'slug' => 'pipedrive_v2_get_projects_phase',
    'class' => 'PipedriveV2GetProjectsPhase',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/phases/{id}',
    'api_version' => 'v2',
    'operation_id' => 'getProjectsPhase',
    'name' => 'Get details of a project phase',
    'description' => 'Get details of a project phase Returns the details of a specific project phase.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project phase',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_projects_phases' =>
  array (
    'slug' => 'pipedrive_v2_get_projects_phases',
    'class' => 'PipedriveV2GetProjectsPhases',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/phases',
    'api_version' => 'v2',
    'operation_id' => 'getProjectsPhases',
    'name' => 'Get project phases',
    'description' => 'Get project phases Returns all active project phases under a specific board.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'board_id',
        'argument_name' => 'board_id',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the board for which phases are requested',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_stage' =>
  array (
    'slug' => 'pipedrive_v2_get_stage',
    'class' => 'PipedriveV2GetStage',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/stages/{id}',
    'api_version' => 'v2',
    'operation_id' => 'getStage',
    'name' => 'Get one stage',
    'description' => 'Get one stage Returns data about a specific stage.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the stage',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_task' =>
  array (
    'slug' => 'pipedrive_v2_get_task',
    'class' => 'PipedriveV2GetTask',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/tasks/{id}',
    'api_version' => 'v2',
    'operation_id' => 'getTask',
    'name' => 'Get details of a task',
    'description' => 'Get details of a task Returns the details of a specific task.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the task',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_tasks' =>
  array (
    'slug' => 'pipedrive_v2_get_tasks',
    'class' => 'PipedriveV2GetTasks',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/tasks',
    'api_version' => 'v2',
    'operation_id' => 'getTasks',
    'name' => 'Get all tasks',
    'description' => 'Get all tasks Returns all tasks.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'is_done',
        'argument_name' => 'is_done',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether the task is done or not. If omitted, both done and not done tasks are returned.',
      ),
      3 =>
      array (
        'name' => 'is_milestone',
        'argument_name' => 'is_milestone',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether the task is a milestone or not. If omitted, both milestone and non-milestone tasks are returned.',
      ),
      4 =>
      array (
        'name' => 'assignee_id',
        'argument_name' => 'assignee_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only tasks assigned to this user are returned',
      ),
      5 =>
      array (
        'name' => 'project_id',
        'argument_name' => 'project_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'If supplied, only tasks belonging to this project are returned',
      ),
      6 =>
      array (
        'name' => 'parent_task_id',
        'argument_name' => 'parent_task_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'If `null` is supplied, only root-level tasks (without a parent) are returned. If an integer is supplied, only subtasks of that specific task are returned. By default all tasks are returned.',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_get_user_followers' =>
  array (
    'slug' => 'pipedrive_v2_get_user_followers',
    'class' => 'PipedriveV2GetUserFollowers',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/users/{id}/followers',
    'api_version' => 'v2',
    'operation_id' => 'getUserFollowers',
    'name' => 'List followers of a user',
    'description' => 'List followers of a user Lists users who are following the user.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the user',
      ),
      1 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      2 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_post_additional_discount' =>
  array (
    'slug' => 'pipedrive_v2_post_additional_discount',
    'class' => 'PipedriveV2PostAdditionalDiscount',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/discounts',
    'api_version' => 'v2',
    'operation_id' => 'postAdditionalDiscount',
    'name' => 'Add a discount to a deal',
    'description' => 'Add a discount to a deal Adds a discount to a deal, changing the deal value if the deal has one-time products attached.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_post_installment' =>
  array (
    'slug' => 'pipedrive_v2_post_installment',
    'class' => 'PipedriveV2PostInstallment',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/installments',
    'api_version' => 'v2',
    'operation_id' => 'postInstallment',
    'name' => 'Add an installment to a deal',
    'description' => 'Add an installment to a deal Adds an installment to a deal. An installment can only be added if the deal includes at least one one-time product. If the deal contains at least one recurring product, adding installments is not allowed. Only available in Growth and above plans.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_search_deals' =>
  array (
    'slug' => 'pipedrive_v2_search_deals',
    'class' => 'PipedriveV2SearchDeals',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/deals/search',
    'api_version' => 'v2',
    'operation_id' => 'searchDeals',
    'name' => 'Search deals',
    'description' => 'Search deals Searches all deals by title, notes and/or custom fields. This endpoint is a wrapper of <a href="https://developers.pipedrive.com/docs/api/v1/ItemSearch#searchItem">/v1/itemSearch</a> with a narrower OAuth scope. Found deals can be filtered by the person ID and the organization ID.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'term',
        'argument_name' => 'term',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The search term to look for. Minimum 2 characters (or 1 if using `exact_match`). Please note that the search term has to be URL encoded.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'argument_name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A comma-separated string array. The fields to perform the search from. Defaults to all of them. Only the following custom field types are searchable: `address`, `varchar`, `text`, `varchar_auto`, `double`, `monetary` and `phone`. Read more about searching by custom fields <a href="https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields" target="_blank" rel="noopener noreferrer">here</a>.',
        'enum' =>
        array (
          0 => 'custom_fields',
          1 => 'notes',
          2 => 'title',
        ),
      ),
      2 =>
      array (
        'name' => 'exact_match',
        'argument_name' => 'exact_match',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When enabled, only full exact matches against the given term are returned. It is <b>not</b> case sensitive.',
      ),
      3 =>
      array (
        'name' => 'person_id',
        'argument_name' => 'person_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Will filter deals by the provided person ID. The upper limit of found deals associated with the person is 2000.',
      ),
      4 =>
      array (
        'name' => 'organization_id',
        'argument_name' => 'organization_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Will filter deals by the provided organization ID. The upper limit of found deals associated with the organization is 2000.',
      ),
      5 =>
      array (
        'name' => 'status',
        'argument_name' => 'status',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Will filter deals by the provided specific status. open = Open, won = Won, lost = Lost. The upper limit of found deals associated with the status is 2000.',
        'enum' =>
        array (
          0 => 'open',
          1 => 'won',
          2 => 'lost',
        ),
      ),
      6 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Supports including optional fields in the results which are not provided by default',
        'enum' =>
        array (
          0 => 'deal.cc_email',
        ),
      ),
      7 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      8 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_search_item' =>
  array (
    'slug' => 'pipedrive_v2_search_item',
    'class' => 'PipedriveV2SearchItem',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/itemSearch',
    'api_version' => 'v2',
    'operation_id' => 'searchItem',
    'name' => 'Perform a search from multiple item types',
    'description' => 'Perform a search from multiple item types Performs a search from your choice of item types and fields.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'term',
        'argument_name' => 'term',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The search term to look for. Minimum 2 characters (or 1 if using `exact_match`). Please note that the search term has to be URL encoded.',
      ),
      1 =>
      array (
        'name' => 'item_types',
        'argument_name' => 'item_types',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A comma-separated string array. The type of items to perform the search from. Defaults to all.',
        'enum' =>
        array (
          0 => 'deal',
          1 => 'person',
          2 => 'organization',
          3 => 'product',
          4 => 'lead',
          5 => 'file',
          6 => 'mail_attachment',
          7 => 'project',
        ),
      ),
      2 =>
      array (
        'name' => 'fields',
        'argument_name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A comma-separated string array. The fields to perform the search from. Defaults to all. Relevant for each item type are:<br> <table> <tr><th><b>Item type</b></th><th><b>Field</b></th></tr> <tr><td>Deal</td><td>`custom_fields`, `notes`, `title`</td></tr> <tr><td>Person</td><td>`custom_fields`, `email`, `name`, `notes`, `phone`</td></tr> <tr><td>Organization</td><td>`address`, `custom_fields`, `name`, `notes`</td></tr> <tr><td>Product</td><td>`code`, `custom_fields`, `name`</td></tr> <tr><td>Lead</td><td>`custom_fields`, `notes`, `title`</td></tr> <tr><td>File</td><td>`name`</td></tr> <tr><td>Mail attachment</td><td>`name`</td></tr> <tr><td>Project</td><td> `custom_fields`, `notes`, `title`, `description` </td></tr> </table> <br> Only the following custom field types are searchable: `address`, `varchar`, `text`, `varchar_auto`, `double`, `monetary` and `phone`. Read more about searching by custom fields <a href="https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields" target="_blank" rel="noopener noreferrer">here</a>.',
        'enum' =>
        array (
          0 => 'address',
          1 => 'code',
          2 => 'custom_fields',
          3 => 'email',
          4 => 'name',
          5 => 'notes',
          6 => 'phone',
          7 => 'title',
          8 => 'description',
        ),
      ),
      3 =>
      array (
        'name' => 'search_for_related_items',
        'argument_name' => 'search_for_related_items',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When enabled, the response will include up to 100 newest related leads and 100 newest related deals for each found person and organization and up to 100 newest related persons for each found organization',
      ),
      4 =>
      array (
        'name' => 'exact_match',
        'argument_name' => 'exact_match',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When enabled, only full exact matches against the given term are returned. It is <b>not</b> case sensitive.',
      ),
      5 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A comma-separated string array. Supports including optional fields in the results which are not provided by default.',
        'enum' =>
        array (
          0 => 'deal.cc_email',
          1 => 'person.picture',
          2 => 'product.price',
        ),
      ),
      6 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 100 is allowed.',
      ),
      7 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_search_item_by_field' =>
  array (
    'slug' => 'pipedrive_v2_search_item_by_field',
    'class' => 'PipedriveV2SearchItemByField',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/itemSearch/field',
    'api_version' => 'v2',
    'operation_id' => 'searchItemByField',
    'name' => 'Perform a search using a specific field from an item type',
    'description' => 'Perform a search using a specific field from an item type Performs a search from the values of a specific field. Results can either be the distinct values of the field (useful for searching autocomplete field values), or the IDs of actual items (deals, leads, persons, organizations or products).',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'term',
        'argument_name' => 'term',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The search term to look for. Minimum 2 characters (or 1 if `match` is `exact`). Please note that the search term has to be URL encoded.',
      ),
      1 =>
      array (
        'name' => 'entity_type',
        'argument_name' => 'entity_type',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The type of the field to perform the search from',
        'enum' =>
        array (
          0 => 'deal',
          1 => 'lead',
          2 => 'person',
          3 => 'organization',
          4 => 'product',
          5 => 'project',
        ),
      ),
      2 =>
      array (
        'name' => 'match',
        'argument_name' => 'match',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The type of match used against the term. The search <b>is</b> case sensitive.<br/><br/> E.g. in case of searching for a value `monkey`, <ul> <li>with `exact` match, you will only find it if term is `monkey`</li> <li>with `beginning` match, you will only find it if the term matches the beginning or the whole string, e.g. `monk` and `monkey`</li> <li>with `middle` match, you will find the it if the term matches any substring of the value, e.g. `onk` and `ke`</li> </ul>.',
        'enum' =>
        array (
          0 => 'exact',
          1 => 'beginning',
          2 => 'middle',
        ),
      ),
      3 =>
      array (
        'name' => 'field',
        'argument_name' => 'field',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The key of the field to search from. The field key can be obtained by fetching the list of the fields using any of the fields\' API GET methods (dealFields, personFields, etc.). Only the following custom field types are searchable: `address`, `varchar`, `text`, `varchar_auto`, `double`, `monetary` and `phone`. Read more about searching by custom fields <a href="https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields" target="_blank" rel="noopener noreferrer">here</a>.',
      ),
      4 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      5 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_search_leads' =>
  array (
    'slug' => 'pipedrive_v2_search_leads',
    'class' => 'PipedriveV2SearchLeads',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/leads/search',
    'api_version' => 'v2',
    'operation_id' => 'searchLeads',
    'name' => 'Search leads',
    'description' => 'Search leads Searches all leads by title, notes and/or custom fields. This endpoint is a wrapper of <a href="https://developers.pipedrive.com/docs/api/v1/ItemSearch#searchItem">/v1/itemSearch</a> with a narrower OAuth scope. Found leads can be filtered by the person ID and the organization ID.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'term',
        'argument_name' => 'term',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The search term to look for. Minimum 2 characters (or 1 if using `exact_match`). Please note that the search term has to be URL encoded.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'argument_name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A comma-separated string array. The fields to perform the search from. Defaults to all of them.',
        'enum' =>
        array (
          0 => 'custom_fields',
          1 => 'notes',
          2 => 'title',
        ),
      ),
      2 =>
      array (
        'name' => 'exact_match',
        'argument_name' => 'exact_match',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When enabled, only full exact matches against the given term are returned. It is <b>not</b> case sensitive.',
      ),
      3 =>
      array (
        'name' => 'person_id',
        'argument_name' => 'person_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Will filter leads by the provided person ID. The upper limit of found leads associated with the person is 2000.',
      ),
      4 =>
      array (
        'name' => 'organization_id',
        'argument_name' => 'organization_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Will filter leads by the provided organization ID. The upper limit of found leads associated with the organization is 2000.',
      ),
      5 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Supports including optional fields in the results which are not provided by default',
        'enum' =>
        array (
          0 => 'lead.was_seen',
        ),
      ),
      6 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      7 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_search_products' =>
  array (
    'slug' => 'pipedrive_v2_search_products',
    'class' => 'PipedriveV2SearchProducts',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/products/search',
    'api_version' => 'v2',
    'operation_id' => 'searchProducts',
    'name' => 'Search products',
    'description' => 'Search products Searches all products by name, code and/or custom fields. This endpoint is a wrapper of <a href="https://developers.pipedrive.com/docs/api/v1/ItemSearch#searchItem">/v1/itemSearch</a> with a narrower OAuth scope.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'term',
        'argument_name' => 'term',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The search term to look for. Minimum 2 characters (or 1 if using `exact_match`). Please note that the search term has to be URL encoded.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'argument_name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A comma-separated string array. The fields to perform the search from. Defaults to all of them. Only the following custom field types are searchable: `address`, `varchar`, `text`, `varchar_auto`, `double`, `monetary` and `phone`. Read more about searching by custom fields <a href="https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields" target="_blank" rel="noopener noreferrer">here</a>.',
        'enum' =>
        array (
          0 => 'code',
          1 => 'custom_fields',
          2 => 'name',
        ),
      ),
      2 =>
      array (
        'name' => 'exact_match',
        'argument_name' => 'exact_match',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When enabled, only full exact matches against the given term are returned. It is <b>not</b> case sensitive.',
      ),
      3 =>
      array (
        'name' => 'include_fields',
        'argument_name' => 'include_fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Supports including optional fields in the results which are not provided by default',
        'enum' =>
        array (
          0 => 'product.price',
        ),
      ),
      4 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      5 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_search_projects' =>
  array (
    'slug' => 'pipedrive_v2_search_projects',
    'class' => 'PipedriveV2SearchProjects',
    'method' => 'GET',
    'base_path' => '/api/v2',
    'path' => '/projects/search',
    'api_version' => 'v2',
    'operation_id' => 'searchProjects',
    'name' => 'Search projects',
    'description' => 'Search projects Searches all projects by title, description, notes and/or custom fields. This endpoint is a wrapper of <a href="https://developers.pipedrive.com/docs/api/v1/ItemSearch#searchItem">/v1/itemSearch</a> with a narrower OAuth scope. Found projects can be filtered by person ID or organization ID.',
    'type' => 'read',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'term',
        'argument_name' => 'term',
        'in' => 'query',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The search term to look for. Minimum 2 characters (or 1 if using `exact_match`). Please note that the search term has to be URL encoded.',
      ),
      1 =>
      array (
        'name' => 'fields',
        'argument_name' => 'fields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A comma-separated string array. The fields to perform the search from. Defaults to all of them. Only the following custom field types are searchable: `address`, `varchar`, `text`, `varchar_auto`, `double`, `monetary` and `phone`. Read more about searching by custom fields <a href="https://support.pipedrive.com/en/article/search-finding-what-you-need#searching-by-custom-fields" target="_blank" rel="noopener noreferrer">here</a>.',
        'enum' =>
        array (
          0 => 'custom_fields',
          1 => 'notes',
          2 => 'title',
          3 => 'description',
        ),
      ),
      2 =>
      array (
        'name' => 'exact_match',
        'argument_name' => 'exact_match',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'When enabled, only full exact matches against the given term are returned. It is <b>not</b> case sensitive.',
      ),
      3 =>
      array (
        'name' => 'person_id',
        'argument_name' => 'person_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Will filter projects by the provided person ID',
      ),
      4 =>
      array (
        'name' => 'organization_id',
        'argument_name' => 'organization_id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Will filter projects by the provided organization ID',
      ),
      5 =>
      array (
        'name' => 'limit',
        'argument_name' => 'limit',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'For pagination, the limit of entries to be returned. If not provided, 100 items will be returned. Please note that a maximum value of 500 is allowed.',
      ),
      6 =>
      array (
        'name' => 'cursor',
        'argument_name' => 'cursor',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'For pagination, the marker (an opaque string value) representing the first item on the next page',
      ),
    ),
    'request_body' => NULL,
  ),
  'pipedrive_v2_update_activity' =>
  array (
    'slug' => 'pipedrive_v2_update_activity',
    'class' => 'PipedriveV2UpdateActivity',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/activities/{id}',
    'api_version' => 'v2',
    'operation_id' => 'updateActivity',
    'name' => 'Update an activity',
    'description' => 'Update an activity Updates the properties of an activity.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the activity',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_additional_discount' =>
  array (
    'slug' => 'pipedrive_v2_update_additional_discount',
    'class' => 'PipedriveV2UpdateAdditionalDiscount',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/discounts/{discount_id}',
    'api_version' => 'v2',
    'operation_id' => 'updateAdditionalDiscount',
    'name' => 'Update a discount added to a deal',
    'description' => 'Update a discount added to a deal Edits a discount added to a deal, changing the deal value if the deal has one-time products attached.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'discount_id',
        'argument_name' => 'discount_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The ID of the discount',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_deal_field' =>
  array (
    'slug' => 'pipedrive_v2_update_deal_field',
    'class' => 'PipedriveV2UpdateDealField',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/dealFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'updateDealField',
    'name' => 'Update one deal field',
    'description' => 'Update one deal field Updates a deal custom field. The field_code and field_type cannot be changed. At least one field must be provided in the request body.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_deal_field_options' =>
  array (
    'slug' => 'pipedrive_v2_update_deal_field_options',
    'class' => 'PipedriveV2UpdateDealFieldOptions',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/dealFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'updateDealFieldOptions',
    'name' => 'Update deal field options in bulk',
    'description' => 'Update deal field options in bulk Updates existing options for a deal custom field. This operation is atomic and fails if any of the specified option IDs do not exist. Returns only the updated options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_deal_product' =>
  array (
    'slug' => 'pipedrive_v2_update_deal_product',
    'class' => 'PipedriveV2UpdateDealProduct',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/products/{product_attachment_id}',
    'api_version' => 'v2',
    'operation_id' => 'updateDealProduct',
    'name' => 'Update the product attached to a deal',
    'description' => 'Update the product attached to a deal Updates the details of the product that has been attached to a deal.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'product_attachment_id',
        'argument_name' => 'product_attachment_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal-product (the ID of the product attached to the deal)',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_installment' =>
  array (
    'slug' => 'pipedrive_v2_update_installment',
    'class' => 'PipedriveV2UpdateInstallment',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/deals/{id}/installments/{installment_id}',
    'api_version' => 'v2',
    'operation_id' => 'updateInstallment',
    'name' => 'Update an installment added to a deal',
    'description' => 'Update an installment added to a deal Edits an installment added to a deal. Only available in Growth and above plans.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the deal',
      ),
      1 =>
      array (
        'name' => 'installment_id',
        'argument_name' => 'installment_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the installment',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_organization_field' =>
  array (
    'slug' => 'pipedrive_v2_update_organization_field',
    'class' => 'PipedriveV2UpdateOrganizationField',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/organizationFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'updateOrganizationField',
    'name' => 'Update one organization field',
    'description' => 'Update one organization field Updates an organization custom field. The field_code and field_type cannot be changed. At least one field must be provided in the request body.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_organization_field_options' =>
  array (
    'slug' => 'pipedrive_v2_update_organization_field_options',
    'class' => 'PipedriveV2UpdateOrganizationFieldOptions',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/organizationFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'updateOrganizationFieldOptions',
    'name' => 'Update organization field options in bulk',
    'description' => 'Update organization field options in bulk Updates existing options for an organization custom field. This operation is atomic and fails if any of the specified option IDs do not exist. Returns only the updated options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_person_field' =>
  array (
    'slug' => 'pipedrive_v2_update_person_field',
    'class' => 'PipedriveV2UpdatePersonField',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/personFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'updatePersonField',
    'name' => 'Update one person field',
    'description' => 'Update one person field Updates a person custom field. The field_code and field_type cannot be changed. At least one field must be provided in the request body.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_person_field_options' =>
  array (
    'slug' => 'pipedrive_v2_update_person_field_options',
    'class' => 'PipedriveV2UpdatePersonFieldOptions',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/personFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'updatePersonFieldOptions',
    'name' => 'Update person field options in bulk',
    'description' => 'Update person field options in bulk Updates existing options for a person custom field. This operation is atomic and fails if any of the specified option IDs do not exist. Returns only the updated options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_pipeline' =>
  array (
    'slug' => 'pipedrive_v2_update_pipeline',
    'class' => 'PipedriveV2UpdatePipeline',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/pipelines/{id}',
    'api_version' => 'v2',
    'operation_id' => 'updatePipeline',
    'name' => 'Update a pipeline',
    'description' => 'Update a pipeline Updates the properties of a pipeline.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the pipeline',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_product' =>
  array (
    'slug' => 'pipedrive_v2_update_product',
    'class' => 'PipedriveV2UpdateProduct',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/products/{id}',
    'api_version' => 'v2',
    'operation_id' => 'updateProduct',
    'name' => 'Update a product',
    'description' => 'Update a product Updates product data.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_product_field' =>
  array (
    'slug' => 'pipedrive_v2_update_product_field',
    'class' => 'PipedriveV2UpdateProductField',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/productFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'updateProductField',
    'name' => 'Update one product field',
    'description' => 'Update one product field Updates a product custom field. The field_code and field_type cannot be changed. At least one field must be provided in the request body.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_product_field_options' =>
  array (
    'slug' => 'pipedrive_v2_update_product_field_options',
    'class' => 'PipedriveV2UpdateProductFieldOptions',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/productFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'updateProductFieldOptions',
    'name' => 'Update product field options in bulk',
    'description' => 'Update product field options in bulk Updates existing options for a product custom field. This operation is atomic and fails if any of the specified option IDs do not exist. Returns only the updated options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_product_image' =>
  array (
    'slug' => 'pipedrive_v2_update_product_image',
    'class' => 'PipedriveV2UpdateProductImage',
    'method' => 'PUT',
    'base_path' => '/api/v2',
    'path' => '/products/{id}/images',
    'api_version' => 'v2',
    'operation_id' => 'updateProductImage',
    'name' => 'Update an image for a product',
    'description' => 'Update an image for a product Updates the image of a product.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_product_variation' =>
  array (
    'slug' => 'pipedrive_v2_update_product_variation',
    'class' => 'PipedriveV2UpdateProductVariation',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/products/{id}/variations/{product_variation_id}',
    'api_version' => 'v2',
    'operation_id' => 'updateProductVariation',
    'name' => 'Update a product variation',
    'description' => 'Update a product variation Updates product variation data.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
      1 =>
      array (
        'name' => 'product_variation_id',
        'argument_name' => 'product_variation_id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product variation',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_project' =>
  array (
    'slug' => 'pipedrive_v2_update_project',
    'class' => 'PipedriveV2UpdateProject',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/projects/{id}',
    'api_version' => 'v2',
    'operation_id' => 'updateProject',
    'name' => 'Update a project',
    'description' => 'Update a project Updates the properties of a project.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_project_board' =>
  array (
    'slug' => 'pipedrive_v2_update_project_board',
    'class' => 'PipedriveV2UpdateProjectBoard',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/boards/{id}',
    'api_version' => 'v2',
    'operation_id' => 'updateProjectBoard',
    'name' => 'Update a project board',
    'description' => 'Update a project board Updates the properties of a project board.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project board',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_project_field' =>
  array (
    'slug' => 'pipedrive_v2_update_project_field',
    'class' => 'PipedriveV2UpdateProjectField',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/projectFields/{field_code}',
    'api_version' => 'v2',
    'operation_id' => 'updateProjectField',
    'name' => 'Update one project field',
    'description' => 'Update one project field Updates a project custom field. The field_code and field_type cannot be changed. At least one field must be provided in the request body.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_project_field_options' =>
  array (
    'slug' => 'pipedrive_v2_update_project_field_options',
    'class' => 'PipedriveV2UpdateProjectFieldOptions',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/projectFields/{field_code}/options',
    'api_version' => 'v2',
    'operation_id' => 'updateProjectFieldOptions',
    'name' => 'Update project field options in bulk',
    'description' => 'Update project field options in bulk Updates existing options for a project custom field. This operation is atomic and fails if any of the specified option IDs do not exist. Returns only the updated options.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'field_code',
        'argument_name' => 'field_code',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The unique code identifying the field',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'array',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_project_phase' =>
  array (
    'slug' => 'pipedrive_v2_update_project_phase',
    'class' => 'PipedriveV2UpdateProjectPhase',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/phases/{id}',
    'api_version' => 'v2',
    'operation_id' => 'updateProjectPhase',
    'name' => 'Update a project phase',
    'description' => 'Update a project phase Updates the properties of a project phase.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the project phase',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_stage' =>
  array (
    'slug' => 'pipedrive_v2_update_stage',
    'class' => 'PipedriveV2UpdateStage',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/stages/{id}',
    'api_version' => 'v2',
    'operation_id' => 'updateStage',
    'name' => 'Update stage details',
    'description' => 'Update stage details Updates the properties of a stage.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the stage',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_update_task' =>
  array (
    'slug' => 'pipedrive_v2_update_task',
    'class' => 'PipedriveV2UpdateTask',
    'method' => 'PATCH',
    'base_path' => '/api/v2',
    'path' => '/tasks/{id}',
    'api_version' => 'v2',
    'operation_id' => 'updateTask',
    'name' => 'Update a task',
    'description' => 'Update a task Updates a task.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the task',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
  'pipedrive_v2_upload_product_image' =>
  array (
    'slug' => 'pipedrive_v2_upload_product_image',
    'class' => 'PipedriveV2UploadProductImage',
    'method' => 'POST',
    'base_path' => '/api/v2',
    'path' => '/products/{id}/images',
    'api_version' => 'v2',
    'operation_id' => 'uploadProductImage',
    'name' => 'Upload an image for a product',
    'description' => 'Upload an image for a product Uploads an image for a product.',
    'type' => 'write',
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id',
        'argument_name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'integer',
        'description' => 'The ID of the product',
      ),
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Request body for the Pipedrive API operation.',
    ),
  ),
);
    }
}
