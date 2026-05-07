<?php

namespace OpenCompany\Integrations\Dialpad;

/**
 * Official Dialpad API operation metadata.
 *
 * Source: https://github.com/dialpad/dialpad-python-sdk/blob/master/dialpad_api_spec.json.
 */
class DialpadOperations
{
    /**
     * Return all supported Dialpad API operations.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
  0 =>
  [
    'operation' => 'accesscontrolpolicies.assign',
    'slug' => 'dialpad_accesscontrolpolicies_assign',
    'class' => 'DialpadAccesscontrolpoliciesAssign',
    'method' => 'POST',
    'path' => '/api/v2/accesscontrolpolicies/{id}/assign',
    'name' => 'Access Control Policies -- Assign',
    'description' => 'Execute official Dialpad API operation `accesscontrolpolicies.assign`.

Endpoint: POST /api/v2/accesscontrolpolicies/{id}/assign.',
    'type' => 'write',
    'tag' => 'accesscontrolpolicies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The access control policy\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  1 =>
  [
    'operation' => 'accesscontrolpolicies.assignments',
    'slug' => 'dialpad_accesscontrolpolicies_assignments',
    'class' => 'DialpadAccesscontrolpoliciesAssignments',
    'method' => 'GET',
    'path' => '/api/v2/accesscontrolpolicies/{id}/assignments',
    'name' => 'Access Control Policies -- List Assignments',
    'description' => 'Execute official Dialpad API operation `accesscontrolpolicies.assignments`.

Endpoint: GET /api/v2/accesscontrolpolicies/{id}/assignments.',
    'type' => 'read',
    'tag' => 'accesscontrolpolicies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The access control policy\'s id.',
      ],
    ],
  ],
  2 =>
  [
    'operation' => 'accesscontrolpolicies.create',
    'slug' => 'dialpad_accesscontrolpolicies_create',
    'class' => 'DialpadAccesscontrolpoliciesCreate',
    'method' => 'POST',
    'path' => '/api/v2/accesscontrolpolicies',
    'name' => 'Access Control Policies -- Create',
    'description' => 'Execute official Dialpad API operation `accesscontrolpolicies.create`.

Endpoint: POST /api/v2/accesscontrolpolicies.',
    'type' => 'write',
    'tag' => 'accesscontrolpolicies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  3 =>
  [
    'operation' => 'accesscontrolpolicies.delete',
    'slug' => 'dialpad_accesscontrolpolicies_delete',
    'class' => 'DialpadAccesscontrolpoliciesDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/accesscontrolpolicies/{id}',
    'name' => 'Access Control Policies -- Delete',
    'description' => 'Execute official Dialpad API operation `accesscontrolpolicies.delete`.

Endpoint: DELETE /api/v2/accesscontrolpolicies/{id}.',
    'type' => 'write',
    'tag' => 'accesscontrolpolicies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The access control policy\'s id.',
      ],
    ],
  ],
  4 =>
  [
    'operation' => 'accesscontrolpolicies.get',
    'slug' => 'dialpad_accesscontrolpolicies_get',
    'class' => 'DialpadAccesscontrolpoliciesGet',
    'method' => 'GET',
    'path' => '/api/v2/accesscontrolpolicies/{id}',
    'name' => 'Access Control Policies -- Get',
    'description' => 'Execute official Dialpad API operation `accesscontrolpolicies.get`.

Endpoint: GET /api/v2/accesscontrolpolicies/{id}.',
    'type' => 'read',
    'tag' => 'accesscontrolpolicies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The access control policy\'s id.',
      ],
    ],
  ],
  5 =>
  [
    'operation' => 'accesscontrolpolicies.list',
    'slug' => 'dialpad_accesscontrolpolicies_list',
    'class' => 'DialpadAccesscontrolpoliciesList',
    'method' => 'GET',
    'path' => '/api/v2/accesscontrolpolicies',
    'name' => 'Access Control Policies -- List Policies',
    'description' => 'Execute official Dialpad API operation `accesscontrolpolicies.list`.

Endpoint: GET /api/v2/accesscontrolpolicies.',
    'type' => 'read',
    'tag' => 'accesscontrolpolicies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
    ],
  ],
  6 =>
  [
    'operation' => 'accesscontrolpolicies.unassign',
    'slug' => 'dialpad_accesscontrolpolicies_unassign',
    'class' => 'DialpadAccesscontrolpoliciesUnassign',
    'method' => 'POST',
    'path' => '/api/v2/accesscontrolpolicies/{id}/unassign',
    'name' => 'Access Control Policies -- Unassign',
    'description' => 'Execute official Dialpad API operation `accesscontrolpolicies.unassign`.

Endpoint: POST /api/v2/accesscontrolpolicies/{id}/unassign.',
    'type' => 'write',
    'tag' => 'accesscontrolpolicies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The access control policy\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  7 =>
  [
    'operation' => 'accesscontrolpolicies.update',
    'slug' => 'dialpad_accesscontrolpolicies_update',
    'class' => 'DialpadAccesscontrolpoliciesUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/accesscontrolpolicies/{id}',
    'name' => 'Access Control Policies -- Update',
    'description' => 'Execute official Dialpad API operation `accesscontrolpolicies.update`.

Endpoint: PATCH /api/v2/accesscontrolpolicies/{id}.',
    'type' => 'write',
    'tag' => 'accesscontrolpolicies',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The access control policy\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  8 =>
  [
    'operation' => 'app_settings.get',
    'slug' => 'dialpad_app_settings_get',
    'class' => 'DialpadAppSettingsGet',
    'method' => 'GET',
    'path' => '/api/v2/app/settings',
    'name' => 'App Settings -- GET',
    'description' => 'Execute official Dialpad API operation `app_settings.get`.

Endpoint: GET /api/v2/app/settings.',
    'type' => 'read',
    'tag' => 'app',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'target_id',
        'param' => 'target_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The target\'s id.',
      ],
      1 =>
      [
        'name' => 'target_type',
        'param' => 'target_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The target\'s type.',
      ],
    ],
  ],
  9 =>
  [
    'operation' => 'blockednumbers.add',
    'slug' => 'dialpad_blockednumbers_add',
    'class' => 'DialpadBlockednumbersAdd',
    'method' => 'POST',
    'path' => '/api/v2/blockednumbers/add',
    'name' => 'Blocked Number -- Add',
    'description' => 'Execute official Dialpad API operation `blockednumbers.add`.

Endpoint: POST /api/v2/blockednumbers/add.',
    'type' => 'write',
    'tag' => 'blockednumbers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  10 =>
  [
    'operation' => 'blockednumbers.get',
    'slug' => 'dialpad_blockednumbers_get',
    'class' => 'DialpadBlockednumbersGet',
    'method' => 'GET',
    'path' => '/api/v2/blockednumbers/{number}',
    'name' => 'Blocked Number -- Get',
    'description' => 'Execute official Dialpad API operation `blockednumbers.get`.

Endpoint: GET /api/v2/blockednumbers/{number}.',
    'type' => 'read',
    'tag' => 'blockednumbers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'number',
        'param' => 'number',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'A phone number (e164 format].',
      ],
    ],
  ],
  11 =>
  [
    'operation' => 'blockednumbers.list',
    'slug' => 'dialpad_blockednumbers_list',
    'class' => 'DialpadBlockednumbersList',
    'method' => 'GET',
    'path' => '/api/v2/blockednumbers',
    'name' => 'Blocked Numbers -- List',
    'description' => 'Execute official Dialpad API operation `blockednumbers.list`.

Endpoint: GET /api/v2/blockednumbers.',
    'type' => 'read',
    'tag' => 'blockednumbers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
    ],
  ],
  12 =>
  [
    'operation' => 'blockednumbers.remove',
    'slug' => 'dialpad_blockednumbers_remove',
    'class' => 'DialpadBlockednumbersRemove',
    'method' => 'POST',
    'path' => '/api/v2/blockednumbers/remove',
    'name' => 'Blocked Number -- Remove',
    'description' => 'Execute official Dialpad API operation `blockednumbers.remove`.

Endpoint: POST /api/v2/blockednumbers/remove.',
    'type' => 'write',
    'tag' => 'blockednumbers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  13 =>
  [
    'operation' => 'call.actions.hangup',
    'slug' => 'dialpad_call_actions_hangup',
    'class' => 'DialpadCallActionsHangup',
    'method' => 'PUT',
    'path' => '/api/v2/call/{id}/actions/hangup',
    'name' => 'Call Actions -- Hang up',
    'description' => 'Execute official Dialpad API operation `call.actions.hangup`.

Endpoint: PUT /api/v2/call/{id}/actions/hangup.',
    'type' => 'write',
    'tag' => 'call',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call\'s id.',
      ],
    ],
  ],
  14 =>
  [
    'operation' => 'call.call',
    'slug' => 'dialpad_call_call',
    'class' => 'DialpadCallCall',
    'method' => 'POST',
    'path' => '/api/v2/call',
    'name' => 'Call -- Initiate via Ring',
    'description' => 'Execute official Dialpad API operation `call.call`.

Endpoint: POST /api/v2/call.',
    'type' => 'write',
    'tag' => 'call',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  15 =>
  [
    'operation' => 'call.get_call_info',
    'slug' => 'dialpad_call_get_call_info',
    'class' => 'DialpadCallGetCallInfo',
    'method' => 'GET',
    'path' => '/api/v2/call/{id}',
    'name' => 'Call -- Get',
    'description' => 'Execute official Dialpad API operation `call.get_call_info`.

Endpoint: GET /api/v2/call/{id}.',
    'type' => 'read',
    'tag' => 'call',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call\'s id.',
      ],
    ],
  ],
  16 =>
  [
    'operation' => 'call.initiate_ivr_call',
    'slug' => 'dialpad_call_initiate_ivr_call',
    'class' => 'DialpadCallInitiateIvrCall',
    'method' => 'POST',
    'path' => '/api/v2/call/initiate_ivr_call',
    'name' => 'Call -- Initiate IVR Call',
    'description' => 'Execute official Dialpad API operation `call.initiate_ivr_call`.

Endpoint: POST /api/v2/call/initiate_ivr_call.',
    'type' => 'write',
    'tag' => 'call',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  17 =>
  [
    'operation' => 'call.list',
    'slug' => 'dialpad_call_list',
    'class' => 'DialpadCallList',
    'method' => 'GET',
    'path' => '/api/v2/call',
    'name' => 'Call -- List',
    'description' => 'Execute official Dialpad API operation `call.list`.

Endpoint: GET /api/v2/call.',
    'type' => 'read',
    'tag' => 'call',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'started_after',
        'param' => 'started_after',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Only includes calls that started more recently than the specified timestamp. (UTC ms-since-epoch timestamp]',
      ],
      2 =>
      [
        'name' => 'started_before',
        'param' => 'started_before',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Only includes calls that started prior to the specified timestamp. (UTC ms-since-epoch timestamp]',
      ],
      3 =>
      [
        'name' => 'target_id',
        'param' => 'target_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The ID of a target to filter against.',
      ],
      4 =>
      [
        'name' => 'target_type',
        'param' => 'target_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The target type associated with the target ID.',
      ],
    ],
  ],
  18 =>
  [
    'operation' => 'call.participants.add',
    'slug' => 'dialpad_call_participants_add',
    'class' => 'DialpadCallParticipantsAdd',
    'method' => 'POST',
    'path' => '/api/v2/call/{id}/participants/add',
    'name' => 'Call -- Add Participant',
    'description' => 'Execute official Dialpad API operation `call.participants.add`.

Endpoint: POST /api/v2/call/{id}/participants/add.',
    'type' => 'write',
    'tag' => 'call',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  19 =>
  [
    'operation' => 'call.put_call_labels',
    'slug' => 'dialpad_call_put_call_labels',
    'class' => 'DialpadCallPutCallLabels',
    'method' => 'PUT',
    'path' => '/api/v2/call/{id}/labels',
    'name' => 'Label -- Set',
    'description' => 'Execute official Dialpad API operation `call.put_call_labels`.

Endpoint: PUT /api/v2/call/{id}/labels.',
    'type' => 'write',
    'tag' => 'call',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call\'s id',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  20 =>
  [
    'operation' => 'call.transfer_call',
    'slug' => 'dialpad_call_transfer_call',
    'class' => 'DialpadCallTransferCall',
    'method' => 'POST',
    'path' => '/api/v2/call/{id}/transfer',
    'name' => 'Call -- Transfer',
    'description' => 'Execute official Dialpad API operation `call.transfer_call`.

Endpoint: POST /api/v2/call/{id}/transfer.',
    'type' => 'write',
    'tag' => 'call',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  21 =>
  [
    'operation' => 'call.unpark',
    'slug' => 'dialpad_call_unpark',
    'class' => 'DialpadCallUnpark',
    'method' => 'POST',
    'path' => '/api/v2/call/{id}/unpark',
    'name' => 'Call -- Unpark',
    'description' => 'Execute official Dialpad API operation `call.unpark`.

Endpoint: POST /api/v2/call/{id}/unpark.',
    'type' => 'write',
    'tag' => 'call',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  22 =>
  [
    'operation' => 'call.callback',
    'slug' => 'dialpad_call_callback',
    'class' => 'DialpadCallCallback',
    'method' => 'POST',
    'path' => '/api/v2/callback',
    'name' => 'Call Back -- Enqueue',
    'description' => 'Execute official Dialpad API operation `call.callback`.

Endpoint: POST /api/v2/callback.',
    'type' => 'write',
    'tag' => 'callback',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  23 =>
  [
    'operation' => 'call.validate_callback',
    'slug' => 'dialpad_call_validate_callback',
    'class' => 'DialpadCallValidateCallback',
    'method' => 'POST',
    'path' => '/api/v2/callback/validate',
    'name' => 'Call Back -- Validate',
    'description' => 'Execute official Dialpad API operation `call.validate_callback`.

Endpoint: POST /api/v2/callback/validate.',
    'type' => 'write',
    'tag' => 'callback',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  24 =>
  [
    'operation' => 'callcenters.create',
    'slug' => 'dialpad_callcenters_create',
    'class' => 'DialpadCallcentersCreate',
    'method' => 'POST',
    'path' => '/api/v2/callcenters',
    'name' => 'Call Centers -- Create',
    'description' => 'Execute official Dialpad API operation `callcenters.create`.

Endpoint: POST /api/v2/callcenters.',
    'type' => 'write',
    'tag' => 'callcenters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  25 =>
  [
    'operation' => 'callcenters.delete',
    'slug' => 'dialpad_callcenters_delete',
    'class' => 'DialpadCallcentersDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/callcenters/{id}',
    'name' => 'Call Centers -- Delete',
    'description' => 'Execute official Dialpad API operation `callcenters.delete`.

Endpoint: DELETE /api/v2/callcenters/{id}.',
    'type' => 'write',
    'tag' => 'callcenters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call center\'s id.',
      ],
    ],
  ],
  26 =>
  [
    'operation' => 'callcenters.get',
    'slug' => 'dialpad_callcenters_get',
    'class' => 'DialpadCallcentersGet',
    'method' => 'GET',
    'path' => '/api/v2/callcenters/{id}',
    'name' => 'Call Centers -- Get',
    'description' => 'Execute official Dialpad API operation `callcenters.get`.

Endpoint: GET /api/v2/callcenters/{id}.',
    'type' => 'read',
    'tag' => 'callcenters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call center\'s id.',
      ],
    ],
  ],
  27 =>
  [
    'operation' => 'callcenters.listall',
    'slug' => 'dialpad_callcenters_listall',
    'class' => 'DialpadCallcentersListall',
    'method' => 'GET',
    'path' => '/api/v2/callcenters',
    'name' => 'Call Centers -- List',
    'description' => 'Execute official Dialpad API operation `callcenters.listall`.

Endpoint: GET /api/v2/callcenters.',
    'type' => 'read',
    'tag' => 'callcenters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'office_id',
        'param' => 'office_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'search call center by office.',
      ],
      2 =>
      [
        'name' => 'name_search',
        'param' => 'name_search',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'search call centers by name or search by the substring of the name. If input example is \'Cool\', output example can be a list of call centers whose name contains the string \'Cool\' - [\'Cool call center 1\', \'Cool call center 2049\']',
      ],
    ],
  ],
  28 =>
  [
    'operation' => 'callcenters.operators.delete',
    'slug' => 'dialpad_callcenters_operators_delete',
    'class' => 'DialpadCallcentersOperatorsDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/callcenters/{id}/operators',
    'name' => 'Operator -- Remove',
    'description' => 'Execute official Dialpad API operation `callcenters.operators.delete`.

Endpoint: DELETE /api/v2/callcenters/{id}/operators.',
    'type' => 'write',
    'tag' => 'callcenters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call center\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  29 =>
  [
    'operation' => 'callcenters.operators.dutystatus',
    'slug' => 'dialpad_callcenters_operators_dutystatus',
    'class' => 'DialpadCallcentersOperatorsDutystatus',
    'method' => 'PATCH',
    'path' => '/api/v2/callcenters/operators/{id}/dutystatus',
    'name' => 'Operator -- Update Duty Status',
    'description' => 'Execute official Dialpad API operation `callcenters.operators.dutystatus`.

Endpoint: PATCH /api/v2/callcenters/operators/{id}/dutystatus.',
    'type' => 'write',
    'tag' => 'callcenters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The operator\'s user id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  30 =>
  [
    'operation' => 'callcenters.operators.get',
    'slug' => 'dialpad_callcenters_operators_get',
    'class' => 'DialpadCallcentersOperatorsGet',
    'method' => 'GET',
    'path' => '/api/v2/callcenters/{id}/operators',
    'name' => 'Operators -- List',
    'description' => 'Execute official Dialpad API operation `callcenters.operators.get`.

Endpoint: GET /api/v2/callcenters/{id}/operators.',
    'type' => 'read',
    'tag' => 'callcenters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call center\'s id.',
      ],
    ],
  ],
  31 =>
  [
    'operation' => 'callcenters.operators.get.dutystatus',
    'slug' => 'dialpad_callcenters_operators_get_dutystatus',
    'class' => 'DialpadCallcentersOperatorsGetDutystatus',
    'method' => 'GET',
    'path' => '/api/v2/callcenters/operators/{id}/dutystatus',
    'name' => 'Operator -- Get Duty Status',
    'description' => 'Execute official Dialpad API operation `callcenters.operators.get.dutystatus`.

Endpoint: GET /api/v2/callcenters/operators/{id}/dutystatus.',
    'type' => 'read',
    'tag' => 'callcenters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The operator\'s user id.',
      ],
    ],
  ],
  32 =>
  [
    'operation' => 'callcenters.operators.get.skilllevel',
    'slug' => 'dialpad_callcenters_operators_get_skilllevel',
    'class' => 'DialpadCallcentersOperatorsGetSkilllevel',
    'method' => 'GET',
    'path' => '/api/v2/callcenters/{call_center_id}/operators/{user_id}/skill',
    'name' => 'Operator -- Get Skill Level',
    'description' => 'Execute official Dialpad API operation `callcenters.operators.get.skilllevel`.

Endpoint: GET /api/v2/callcenters/{call_center_id}/operators/{user_id}/skill.',
    'type' => 'read',
    'tag' => 'callcenters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'call_center_id',
        'param' => 'call_center_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call center\'s ID',
      ],
      1 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The operator\'s ID',
      ],
    ],
  ],
  33 =>
  [
    'operation' => 'callcenters.operators.post',
    'slug' => 'dialpad_callcenters_operators_post',
    'class' => 'DialpadCallcentersOperatorsPost',
    'method' => 'POST',
    'path' => '/api/v2/callcenters/{id}/operators',
    'name' => 'Operator -- Add',
    'description' => 'Execute official Dialpad API operation `callcenters.operators.post`.

Endpoint: POST /api/v2/callcenters/{id}/operators.',
    'type' => 'write',
    'tag' => 'callcenters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call center\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  34 =>
  [
    'operation' => 'callcenters.operators.skilllevel',
    'slug' => 'dialpad_callcenters_operators_skilllevel',
    'class' => 'DialpadCallcentersOperatorsSkilllevel',
    'method' => 'PATCH',
    'path' => '/api/v2/callcenters/{call_center_id}/operators/{user_id}/skill',
    'name' => 'Operator -- Update Skill Level',
    'description' => 'Execute official Dialpad API operation `callcenters.operators.skilllevel`.

Endpoint: PATCH /api/v2/callcenters/{call_center_id}/operators/{user_id}/skill.',
    'type' => 'write',
    'tag' => 'callcenters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'call_center_id',
        'param' => 'call_center_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call center\'s ID',
      ],
      1 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The operator\'s ID',
      ],
      2 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  35 =>
  [
    'operation' => 'callcenters.status',
    'slug' => 'dialpad_callcenters_status',
    'class' => 'DialpadCallcentersStatus',
    'method' => 'GET',
    'path' => '/api/v2/callcenters/{id}/status',
    'name' => 'Call Centers -- Status',
    'description' => 'Execute official Dialpad API operation `callcenters.status`.

Endpoint: GET /api/v2/callcenters/{id}/status.',
    'type' => 'read',
    'tag' => 'callcenters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call center\'s id.',
      ],
    ],
  ],
  36 =>
  [
    'operation' => 'callcenters.update',
    'slug' => 'dialpad_callcenters_update',
    'class' => 'DialpadCallcentersUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/callcenters/{id}',
    'name' => 'Call Centers -- Update',
    'description' => 'Execute official Dialpad API operation `callcenters.update`.

Endpoint: PATCH /api/v2/callcenters/{id}.',
    'type' => 'write',
    'tag' => 'callcenters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call center\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  37 =>
  [
    'operation' => 'calllabel.list',
    'slug' => 'dialpad_calllabel_list',
    'class' => 'DialpadCalllabelList',
    'method' => 'GET',
    'path' => '/api/v2/calllabels',
    'name' => 'Label -- List',
    'description' => 'Execute official Dialpad API operation `calllabel.list`.

Endpoint: GET /api/v2/calllabels.',
    'type' => 'read',
    'tag' => 'calllabels',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'limit',
        'param' => 'limit',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The maximum number of results to return.',
      ],
    ],
  ],
  38 =>
  [
    'operation' => 'call_review_share_link.create',
    'slug' => 'dialpad_call_review_share_link_create',
    'class' => 'DialpadCallReviewShareLinkCreate',
    'method' => 'POST',
    'path' => '/api/v2/callreviewsharelink',
    'name' => 'Call Review Sharelink -- Create',
    'description' => 'Execute official Dialpad API operation `call_review_share_link.create`.

Endpoint: POST /api/v2/callreviewsharelink.',
    'type' => 'write',
    'tag' => 'callreviewsharelink',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  39 =>
  [
    'operation' => 'call_review_share_link.delete',
    'slug' => 'dialpad_call_review_share_link_delete',
    'class' => 'DialpadCallReviewShareLinkDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/callreviewsharelink/{id}',
    'name' => 'Call Review Sharelink -- Delete',
    'description' => 'Execute official Dialpad API operation `call_review_share_link.delete`.

Endpoint: DELETE /api/v2/callreviewsharelink/{id}.',
    'type' => 'write',
    'tag' => 'callreviewsharelink',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The share link\'s id.',
      ],
    ],
  ],
  40 =>
  [
    'operation' => 'call_review_share_link.get',
    'slug' => 'dialpad_call_review_share_link_get',
    'class' => 'DialpadCallReviewShareLinkGet',
    'method' => 'GET',
    'path' => '/api/v2/callreviewsharelink/{id}',
    'name' => 'Call Review Sharelink -- Get',
    'description' => 'Execute official Dialpad API operation `call_review_share_link.get`.

Endpoint: GET /api/v2/callreviewsharelink/{id}.',
    'type' => 'read',
    'tag' => 'callreviewsharelink',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The share link\'s id.',
      ],
    ],
  ],
  41 =>
  [
    'operation' => 'call_review_share_link.update',
    'slug' => 'dialpad_call_review_share_link_update',
    'class' => 'DialpadCallReviewShareLinkUpdate',
    'method' => 'PUT',
    'path' => '/api/v2/callreviewsharelink/{id}',
    'name' => 'Call Review Sharelink -- Update',
    'description' => 'Execute official Dialpad API operation `call_review_share_link.update`.

Endpoint: PUT /api/v2/callreviewsharelink/{id}.',
    'type' => 'write',
    'tag' => 'callreviewsharelink',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The share link\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  42 =>
  [
    'operation' => 'callrouters.create',
    'slug' => 'dialpad_callrouters_create',
    'class' => 'DialpadCallroutersCreate',
    'method' => 'POST',
    'path' => '/api/v2/callrouters',
    'name' => 'Call Router -- Create',
    'description' => 'Execute official Dialpad API operation `callrouters.create`.

Endpoint: POST /api/v2/callrouters.',
    'type' => 'write',
    'tag' => 'callrouters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  43 =>
  [
    'operation' => 'callrouters.delete',
    'slug' => 'dialpad_callrouters_delete',
    'class' => 'DialpadCallroutersDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/callrouters/{id}',
    'name' => 'Call Router -- Delete',
    'description' => 'Execute official Dialpad API operation `callrouters.delete`.

Endpoint: DELETE /api/v2/callrouters/{id}.',
    'type' => 'write',
    'tag' => 'callrouters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The API call router\'s ID',
      ],
    ],
  ],
  44 =>
  [
    'operation' => 'callrouters.get',
    'slug' => 'dialpad_callrouters_get',
    'class' => 'DialpadCallroutersGet',
    'method' => 'GET',
    'path' => '/api/v2/callrouters/{id}',
    'name' => 'Call Router -- Get',
    'description' => 'Execute official Dialpad API operation `callrouters.get`.

Endpoint: GET /api/v2/callrouters/{id}.',
    'type' => 'read',
    'tag' => 'callrouters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The API call router\'s ID',
      ],
    ],
  ],
  45 =>
  [
    'operation' => 'callrouters.list',
    'slug' => 'dialpad_callrouters_list',
    'class' => 'DialpadCallroutersList',
    'method' => 'GET',
    'path' => '/api/v2/callrouters',
    'name' => 'Call Router -- List',
    'description' => 'Execute official Dialpad API operation `callrouters.list`.

Endpoint: GET /api/v2/callrouters.',
    'type' => 'read',
    'tag' => 'callrouters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'office_id',
        'param' => 'office_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The office\'s id.',
      ],
    ],
  ],
  46 =>
  [
    'operation' => 'callrouters.update',
    'slug' => 'dialpad_callrouters_update',
    'class' => 'DialpadCallroutersUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/callrouters/{id}',
    'name' => 'Call Router -- Update',
    'description' => 'Execute official Dialpad API operation `callrouters.update`.

Endpoint: PATCH /api/v2/callrouters/{id}.',
    'type' => 'write',
    'tag' => 'callrouters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The API call router\'s ID',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  47 =>
  [
    'operation' => 'numbers.assign_call_router_number.post',
    'slug' => 'dialpad_numbers_assign_call_router_number_post',
    'class' => 'DialpadNumbersAssignCallRouterNumberPost',
    'method' => 'POST',
    'path' => '/api/v2/callrouters/{id}/assign_number',
    'name' => 'Dialpad Number -- Assign',
    'description' => 'Execute official Dialpad API operation `numbers.assign_call_router_number.post`.

Endpoint: POST /api/v2/callrouters/{id}/assign_number.',
    'type' => 'write',
    'tag' => 'callrouters',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The API call router\'s ID',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  48 =>
  [
    'operation' => 'channels.delete',
    'slug' => 'dialpad_channels_delete',
    'class' => 'DialpadChannelsDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/channels/{id}',
    'name' => 'Channel -- Delete',
    'description' => 'Execute official Dialpad API operation `channels.delete`.

Endpoint: DELETE /api/v2/channels/{id}.',
    'type' => 'write',
    'tag' => 'channels',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The channel id.',
      ],
    ],
  ],
  49 =>
  [
    'operation' => 'channels.get',
    'slug' => 'dialpad_channels_get',
    'class' => 'DialpadChannelsGet',
    'method' => 'GET',
    'path' => '/api/v2/channels/{id}',
    'name' => 'Channel -- Get',
    'description' => 'Execute official Dialpad API operation `channels.get`.

Endpoint: GET /api/v2/channels/{id}.',
    'type' => 'read',
    'tag' => 'channels',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The channel id.',
      ],
    ],
  ],
  50 =>
  [
    'operation' => 'channels.list',
    'slug' => 'dialpad_channels_list',
    'class' => 'DialpadChannelsList',
    'method' => 'GET',
    'path' => '/api/v2/channels',
    'name' => 'Channel -- List',
    'description' => 'Execute official Dialpad API operation `channels.list`.

Endpoint: GET /api/v2/channels.',
    'type' => 'read',
    'tag' => 'channels',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'state',
        'param' => 'state',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The state of the channel.',
      ],
    ],
  ],
  51 =>
  [
    'operation' => 'channels.members.delete',
    'slug' => 'dialpad_channels_members_delete',
    'class' => 'DialpadChannelsMembersDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/channels/{id}/members',
    'name' => 'Member -- Remove',
    'description' => 'Execute official Dialpad API operation `channels.members.delete`.

Endpoint: DELETE /api/v2/channels/{id}/members.',
    'type' => 'write',
    'tag' => 'channels',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The channel\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  52 =>
  [
    'operation' => 'channels.members.list',
    'slug' => 'dialpad_channels_members_list',
    'class' => 'DialpadChannelsMembersList',
    'method' => 'GET',
    'path' => '/api/v2/channels/{id}/members',
    'name' => 'Members -- List',
    'description' => 'Execute official Dialpad API operation `channels.members.list`.

Endpoint: GET /api/v2/channels/{id}/members.',
    'type' => 'read',
    'tag' => 'channels',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The channel id',
      ],
    ],
  ],
  53 =>
  [
    'operation' => 'channels.members.post',
    'slug' => 'dialpad_channels_members_post',
    'class' => 'DialpadChannelsMembersPost',
    'method' => 'POST',
    'path' => '/api/v2/channels/{id}/members',
    'name' => 'Member -- Add',
    'description' => 'Execute official Dialpad API operation `channels.members.post`.

Endpoint: POST /api/v2/channels/{id}/members.',
    'type' => 'write',
    'tag' => 'channels',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The channel\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  54 =>
  [
    'operation' => 'channels.post',
    'slug' => 'dialpad_channels_post',
    'class' => 'DialpadChannelsPost',
    'method' => 'POST',
    'path' => '/api/v2/channels',
    'name' => 'Channel -- Create',
    'description' => 'Execute official Dialpad API operation `channels.post`.

Endpoint: POST /api/v2/channels.',
    'type' => 'write',
    'tag' => 'channels',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  55 =>
  [
    'operation' => 'coaching_team.get',
    'slug' => 'dialpad_coaching_team_get',
    'class' => 'DialpadCoachingTeamGet',
    'method' => 'GET',
    'path' => '/api/v2/coachingteams/{id}',
    'name' => 'Coaching Team -- Get',
    'description' => 'Execute official Dialpad API operation `coaching_team.get`.

Endpoint: GET /api/v2/coachingteams/{id}.',
    'type' => 'read',
    'tag' => 'coachingteams',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'Id of the coaching team',
      ],
    ],
  ],
  56 =>
  [
    'operation' => 'coaching_team.listall',
    'slug' => 'dialpad_coaching_team_listall',
    'class' => 'DialpadCoachingTeamListall',
    'method' => 'GET',
    'path' => '/api/v2/coachingteams',
    'name' => 'Coaching Team -- List',
    'description' => 'Execute official Dialpad API operation `coaching_team.listall`.

Endpoint: GET /api/v2/coachingteams.',
    'type' => 'read',
    'tag' => 'coachingteams',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
    ],
  ],
  57 =>
  [
    'operation' => 'coaching_team.members.add',
    'slug' => 'dialpad_coaching_team_members_add',
    'class' => 'DialpadCoachingTeamMembersAdd',
    'method' => 'POST',
    'path' => '/api/v2/coachingteams/{id}/members',
    'name' => 'Coaching Team -- Add Member',
    'description' => 'Execute official Dialpad API operation `coaching_team.members.add`.

Endpoint: POST /api/v2/coachingteams/{id}/members.',
    'type' => 'write',
    'tag' => 'coachingteams',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'Id of the coaching team',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  58 =>
  [
    'operation' => 'coaching_team.members.get',
    'slug' => 'dialpad_coaching_team_members_get',
    'class' => 'DialpadCoachingTeamMembersGet',
    'method' => 'GET',
    'path' => '/api/v2/coachingteams/{id}/members',
    'name' => 'Coaching Team -- List Members',
    'description' => 'Execute official Dialpad API operation `coaching_team.members.get`.

Endpoint: GET /api/v2/coachingteams/{id}/members.',
    'type' => 'read',
    'tag' => 'coachingteams',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'Id of the coaching team',
      ],
    ],
  ],
  59 =>
  [
    'operation' => 'company.get',
    'slug' => 'dialpad_company_get',
    'class' => 'DialpadCompanyGet',
    'method' => 'GET',
    'path' => '/api/v2/company',
    'name' => 'Company -- Get',
    'description' => 'Execute official Dialpad API operation `company.get`.

Endpoint: GET /api/v2/company.',
    'type' => 'read',
    'tag' => 'company',
    'parameters' =>
    [
    ],
  ],
  60 =>
  [
    'operation' => 'company.sms_opt_out',
    'slug' => 'dialpad_company_sms_opt_out',
    'class' => 'DialpadCompanySmsOptOut',
    'method' => 'GET',
    'path' => '/api/v2/company/{id}/smsoptout',
    'name' => 'Company -- Get SMS Opt-out List',
    'description' => 'Execute official Dialpad API operation `company.sms_opt_out`.

Endpoint: GET /api/v2/company/{id}/smsoptout.',
    'type' => 'read',
    'tag' => 'company',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'ID of the requested company. This is required and must be specified in the URL path. The value must match the id from the company linked to the API key.',
      ],
      1 =>
      [
        'name' => 'a2p_campaign_id',
        'param' => 'a2p_campaign_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'Optional company A2P campaign entity id to filter results by. Note, if set, then the parameter \'opt_out_state\' must be also set to the value \'opted_out\'.',
      ],
      2 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Optional token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      3 =>
      [
        'name' => 'opt_out_state',
        'param' => 'opt_out_state',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Required opt-out state to filter results by. Only results matching this state will be returned.',
      ],
    ],
  ],
  61 =>
  [
    'operation' => 'conference-meetings.list',
    'slug' => 'dialpad_conference_meetings_list',
    'class' => 'DialpadConferenceMeetingsList',
    'method' => 'GET',
    'path' => '/api/v2/conference/meetings',
    'name' => 'Meeting Summary -- List',
    'description' => 'Execute official Dialpad API operation `conference-meetings.list`.

Endpoint: GET /api/v2/conference/meetings.',
    'type' => 'read',
    'tag' => 'conference',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'room_id',
        'param' => 'room_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The meeting room\'s ID.',
      ],
    ],
  ],
  62 =>
  [
    'operation' => 'conference-rooms.list',
    'slug' => 'dialpad_conference_rooms_list',
    'class' => 'DialpadConferenceRoomsList',
    'method' => 'GET',
    'path' => '/api/v2/conference/rooms',
    'name' => 'Meeting Room -- List',
    'description' => 'Execute official Dialpad API operation `conference-rooms.list`.

Endpoint: GET /api/v2/conference/rooms.',
    'type' => 'read',
    'tag' => 'conference',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
    ],
  ],
  63 =>
  [
    'operation' => 'contacts.create',
    'slug' => 'dialpad_contacts_create',
    'class' => 'DialpadContactsCreate',
    'method' => 'POST',
    'path' => '/api/v2/contacts',
    'name' => 'Contact -- Create',
    'description' => 'Execute official Dialpad API operation `contacts.create`.

Endpoint: POST /api/v2/contacts.',
    'type' => 'write',
    'tag' => 'contacts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  64 =>
  [
    'operation' => 'contacts.create_with_uid',
    'slug' => 'dialpad_contacts_create_with_uid',
    'class' => 'DialpadContactsCreateWithUid',
    'method' => 'PUT',
    'path' => '/api/v2/contacts',
    'name' => 'Contact -- Create or Update',
    'description' => 'Execute official Dialpad API operation `contacts.create_with_uid`.

Endpoint: PUT /api/v2/contacts.',
    'type' => 'write',
    'tag' => 'contacts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  65 =>
  [
    'operation' => 'contacts.delete',
    'slug' => 'dialpad_contacts_delete',
    'class' => 'DialpadContactsDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/contacts/{id}',
    'name' => 'Contact -- Delete',
    'description' => 'Execute official Dialpad API operation `contacts.delete`.

Endpoint: DELETE /api/v2/contacts/{id}.',
    'type' => 'write',
    'tag' => 'contacts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The contact\'s id.',
      ],
    ],
  ],
  66 =>
  [
    'operation' => 'contacts.get',
    'slug' => 'dialpad_contacts_get',
    'class' => 'DialpadContactsGet',
    'method' => 'GET',
    'path' => '/api/v2/contacts/{id}',
    'name' => 'Contact -- Get',
    'description' => 'Execute official Dialpad API operation `contacts.get`.

Endpoint: GET /api/v2/contacts/{id}.',
    'type' => 'read',
    'tag' => 'contacts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The contact\'s id.',
      ],
    ],
  ],
  67 =>
  [
    'operation' => 'contacts.list',
    'slug' => 'dialpad_contacts_list',
    'class' => 'DialpadContactsList',
    'method' => 'GET',
    'path' => '/api/v2/contacts',
    'name' => 'Contact -- List',
    'description' => 'Execute official Dialpad API operation `contacts.list`.

Endpoint: GET /api/v2/contacts.',
    'type' => 'read',
    'tag' => 'contacts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'include_local',
        'param' => 'include_local',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If set to True company local contacts will be included. default False.',
      ],
      2 =>
      [
        'name' => 'owner_id',
        'param' => 'owner_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The id of the user who owns the contact.',
      ],
    ],
  ],
  68 =>
  [
    'operation' => 'contacts.update',
    'slug' => 'dialpad_contacts_update',
    'class' => 'DialpadContactsUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/contacts/{id}',
    'name' => 'Contact -- Update',
    'description' => 'Execute official Dialpad API operation `contacts.update`.

Endpoint: PATCH /api/v2/contacts/{id}.',
    'type' => 'write',
    'tag' => 'contacts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The contact\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  69 =>
  [
    'operation' => 'custom_ivrs.get',
    'slug' => 'dialpad_custom_ivrs_get',
    'class' => 'DialpadCustomIvrsGet',
    'method' => 'GET',
    'path' => '/api/v2/customivrs',
    'name' => 'Custom IVR -- Get',
    'description' => 'Execute official Dialpad API operation `custom_ivrs.get`.

Endpoint: GET /api/v2/customivrs.',
    'type' => 'read',
    'tag' => 'customivrs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'target_type',
        'param' => 'target_type',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'Target\'s type.',
      ],
      2 =>
      [
        'name' => 'target_id',
        'param' => 'target_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => true,
        'description' => 'The target\'s id.',
      ],
    ],
  ],
  70 =>
  [
    'operation' => 'ivr.create',
    'slug' => 'dialpad_ivr_create',
    'class' => 'DialpadIvrCreate',
    'method' => 'POST',
    'path' => '/api/v2/customivrs',
    'name' => 'Custom IVR -- Create',
    'description' => 'Execute official Dialpad API operation `ivr.create`.

Endpoint: POST /api/v2/customivrs.',
    'type' => 'write',
    'tag' => 'customivrs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  71 =>
  [
    'operation' => 'ivr.delete',
    'slug' => 'dialpad_ivr_delete',
    'class' => 'DialpadIvrDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/customivrs/{target_type}/{target_id}/{ivr_type}',
    'name' => 'Custom IVR -- Delete',
    'description' => 'Execute official Dialpad API operation `ivr.delete`.

Endpoint: DELETE /api/v2/customivrs/{target_type}/{target_id}/{ivr_type}.',
    'type' => 'write',
    'tag' => 'customivrs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'target_type',
        'param' => 'target_type',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Target\'s type. of the custom ivr to be updated.',
      ],
      1 =>
      [
        'name' => 'target_id',
        'param' => 'target_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The id of the target.',
      ],
      2 =>
      [
        'name' => 'ivr_type',
        'param' => 'ivr_type',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Type of ivr you want to update.',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  72 =>
  [
    'operation' => 'ivr.update',
    'slug' => 'dialpad_ivr_update',
    'class' => 'DialpadIvrUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/customivrs/{target_type}/{target_id}/{ivr_type}',
    'name' => 'Custom IVR -- Assign',
    'description' => 'Execute official Dialpad API operation `ivr.update`.

Endpoint: PATCH /api/v2/customivrs/{target_type}/{target_id}/{ivr_type}.',
    'type' => 'write',
    'tag' => 'customivrs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'target_type',
        'param' => 'target_type',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Target\'s type.',
      ],
      1 =>
      [
        'name' => 'target_id',
        'param' => 'target_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The target\'s id.',
      ],
      2 =>
      [
        'name' => 'ivr_type',
        'param' => 'ivr_type',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Type of ivr you want to update',
      ],
      3 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  73 =>
  [
    'operation' => 'ivr_details.update',
    'slug' => 'dialpad_ivr_details_update',
    'class' => 'DialpadIvrDetailsUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/customivrs/{ivr_id}',
    'name' => 'Custom IVR -- Update',
    'description' => 'Execute official Dialpad API operation `ivr_details.update`.

Endpoint: PATCH /api/v2/customivrs/{ivr_id}.',
    'type' => 'write',
    'tag' => 'customivrs',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'ivr_id',
        'param' => 'ivr_id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The ID of the custom ivr to be updated.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  74 =>
  [
    'operation' => 'departments.create',
    'slug' => 'dialpad_departments_create',
    'class' => 'DialpadDepartmentsCreate',
    'method' => 'POST',
    'path' => '/api/v2/departments',
    'name' => 'Departments-- Create',
    'description' => 'Execute official Dialpad API operation `departments.create`.

Endpoint: POST /api/v2/departments.',
    'type' => 'write',
    'tag' => 'departments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  75 =>
  [
    'operation' => 'departments.delete',
    'slug' => 'dialpad_departments_delete',
    'class' => 'DialpadDepartmentsDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/departments/{id}',
    'name' => 'Departments-- Delete',
    'description' => 'Execute official Dialpad API operation `departments.delete`.

Endpoint: DELETE /api/v2/departments/{id}.',
    'type' => 'write',
    'tag' => 'departments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The department\'s id.',
      ],
    ],
  ],
  76 =>
  [
    'operation' => 'departments.get',
    'slug' => 'dialpad_departments_get',
    'class' => 'DialpadDepartmentsGet',
    'method' => 'GET',
    'path' => '/api/v2/departments/{id}',
    'name' => 'Department -- Get',
    'description' => 'Execute official Dialpad API operation `departments.get`.

Endpoint: GET /api/v2/departments/{id}.',
    'type' => 'read',
    'tag' => 'departments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The department\'s id.',
      ],
    ],
  ],
  77 =>
  [
    'operation' => 'departments.listall',
    'slug' => 'dialpad_departments_listall',
    'class' => 'DialpadDepartmentsListall',
    'method' => 'GET',
    'path' => '/api/v2/departments',
    'name' => 'Department -- List',
    'description' => 'Execute official Dialpad API operation `departments.listall`.

Endpoint: GET /api/v2/departments.',
    'type' => 'read',
    'tag' => 'departments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'office_id',
        'param' => 'office_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'filter departments by office.',
      ],
      2 =>
      [
        'name' => 'name_search',
        'param' => 'name_search',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'search departments by name or search by the substring of the name. If input example is \'Happy\', output example can be a list of departments whose name contains the string Happy - [\'Happy department 1\', \'Happy department 2\']',
      ],
    ],
  ],
  78 =>
  [
    'operation' => 'departments.operators.delete',
    'slug' => 'dialpad_departments_operators_delete',
    'class' => 'DialpadDepartmentsOperatorsDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/departments/{id}/operators',
    'name' => 'Operator -- Remove',
    'description' => 'Execute official Dialpad API operation `departments.operators.delete`.

Endpoint: DELETE /api/v2/departments/{id}/operators.',
    'type' => 'write',
    'tag' => 'departments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The department\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  79 =>
  [
    'operation' => 'departments.operators.get',
    'slug' => 'dialpad_departments_operators_get',
    'class' => 'DialpadDepartmentsOperatorsGet',
    'method' => 'GET',
    'path' => '/api/v2/departments/{id}/operators',
    'name' => 'Operator -- List',
    'description' => 'Execute official Dialpad API operation `departments.operators.get`.

Endpoint: GET /api/v2/departments/{id}/operators.',
    'type' => 'read',
    'tag' => 'departments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The department\'s id.',
      ],
    ],
  ],
  80 =>
  [
    'operation' => 'departments.operators.post',
    'slug' => 'dialpad_departments_operators_post',
    'class' => 'DialpadDepartmentsOperatorsPost',
    'method' => 'POST',
    'path' => '/api/v2/departments/{id}/operators',
    'name' => 'Operator -- Add',
    'description' => 'Execute official Dialpad API operation `departments.operators.post`.

Endpoint: POST /api/v2/departments/{id}/operators.',
    'type' => 'write',
    'tag' => 'departments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The department\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  81 =>
  [
    'operation' => 'departments.update',
    'slug' => 'dialpad_departments_update',
    'class' => 'DialpadDepartmentsUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/departments/{id}',
    'name' => 'Departments-- Update',
    'description' => 'Execute official Dialpad API operation `departments.update`.

Endpoint: PATCH /api/v2/departments/{id}.',
    'type' => 'write',
    'tag' => 'departments',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call center\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  82 =>
  [
    'operation' => 'faxline.create',
    'slug' => 'dialpad_faxline_create',
    'class' => 'DialpadFaxlineCreate',
    'method' => 'POST',
    'path' => '/api/v2/faxline',
    'name' => 'Fax Line -- Assign',
    'description' => 'Execute official Dialpad API operation `faxline.create`.

Endpoint: POST /api/v2/faxline.',
    'type' => 'write',
    'tag' => 'faxline',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  83 =>
  [
    'operation' => 'format.post',
    'slug' => 'dialpad_format_post',
    'class' => 'DialpadFormatPost',
    'method' => 'POST',
    'path' => '/api/v2/numbers/format',
    'name' => 'Phone String -- Reformat',
    'description' => 'Execute official Dialpad API operation `format.post`.

Endpoint: POST /api/v2/numbers/format.',
    'type' => 'write',
    'tag' => 'numbers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'country_code',
        'param' => 'country_code',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Country code in ISO 3166-1 alpha-2 format such as "US". Required when sending local formatted phone number',
      ],
      1 =>
      [
        'name' => 'number',
        'param' => 'number',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Phone number in local or E.164 format',
      ],
    ],
  ],
  84 =>
  [
    'operation' => 'numbers.assign_number.post',
    'slug' => 'dialpad_numbers_assign_number_post',
    'class' => 'DialpadNumbersAssignNumberPost',
    'method' => 'POST',
    'path' => '/api/v2/numbers/{number}/assign',
    'name' => 'Dialpad Number -- Assign',
    'description' => 'Execute official Dialpad API operation `numbers.assign_number.post`.

Endpoint: POST /api/v2/numbers/{number}/assign.',
    'type' => 'write',
    'tag' => 'numbers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'number',
        'param' => 'number',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'A specific number to assign',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  85 =>
  [
    'operation' => 'numbers.assign_target_number.post',
    'slug' => 'dialpad_numbers_assign_target_number_post',
    'class' => 'DialpadNumbersAssignTargetNumberPost',
    'method' => 'POST',
    'path' => '/api/v2/numbers/assign',
    'name' => 'Dialpad Number -- Auto-Assign',
    'description' => 'Execute official Dialpad API operation `numbers.assign_target_number.post`.

Endpoint: POST /api/v2/numbers/assign.',
    'type' => 'write',
    'tag' => 'numbers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  86 =>
  [
    'operation' => 'numbers.delete',
    'slug' => 'dialpad_numbers_delete',
    'class' => 'DialpadNumbersDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/numbers/{number}',
    'name' => 'Dialpad Number -- Unassign',
    'description' => 'Execute official Dialpad API operation `numbers.delete`.

Endpoint: DELETE /api/v2/numbers/{number}.',
    'type' => 'write',
    'tag' => 'numbers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'number',
        'param' => 'number',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'A phone number (e164 format].',
      ],
      1 =>
      [
        'name' => 'release',
        'param' => 'release',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Releases the number (does not return it to the company reserved pool].',
      ],
    ],
  ],
  87 =>
  [
    'operation' => 'numbers.get',
    'slug' => 'dialpad_numbers_get',
    'class' => 'DialpadNumbersGet',
    'method' => 'GET',
    'path' => '/api/v2/numbers/{number}',
    'name' => 'Dialpad Number -- Get',
    'description' => 'Execute official Dialpad API operation `numbers.get`.

Endpoint: GET /api/v2/numbers/{number}.',
    'type' => 'read',
    'tag' => 'numbers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'number',
        'param' => 'number',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'A phone number (e164 format].',
      ],
    ],
  ],
  88 =>
  [
    'operation' => 'numbers.list',
    'slug' => 'dialpad_numbers_list',
    'class' => 'DialpadNumbersList',
    'method' => 'GET',
    'path' => '/api/v2/numbers',
    'name' => 'Dialpad Number -- List',
    'description' => 'Execute official Dialpad API operation `numbers.list`.

Endpoint: GET /api/v2/numbers.',
    'type' => 'read',
    'tag' => 'numbers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'status',
        'param' => 'status',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Status to filter by.',
      ],
    ],
  ],
  89 =>
  [
    'operation' => 'numbers.swap_number.post',
    'slug' => 'dialpad_numbers_swap_number_post',
    'class' => 'DialpadNumbersSwapNumberPost',
    'method' => 'POST',
    'path' => '/api/v2/numbers/swap',
    'name' => 'Dialpad Number -- Swap',
    'description' => 'Execute official Dialpad API operation `numbers.swap_number.post`.

Endpoint: POST /api/v2/numbers/swap.',
    'type' => 'write',
    'tag' => 'numbers',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  90 =>
  [
    'operation' => 'oauth2.authorize.get',
    'slug' => 'dialpad_oauth2_authorize_get',
    'class' => 'DialpadOauth2AuthorizeGet',
    'method' => 'GET',
    'path' => '/oauth2/authorize',
    'name' => 'Token -- Authorize',
    'description' => 'Execute official Dialpad API operation `oauth2.authorize.get`.

Endpoint: GET /oauth2/authorize.',
    'type' => 'read',
    'tag' => 'oauth2',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'code_challenge_method',
        'param' => 'code_challenge_method',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'PKCE challenge method (hashing algorithm].',
      ],
      1 =>
      [
        'name' => 'code_challenge',
        'param' => 'code_challenge',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'PKCE challenge value (hash commitment].',
      ],
      2 =>
      [
        'name' => 'scope',
        'param' => 'scope',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Space-separated list of additional scopes that should be granted to the vended token.',
      ],
      3 =>
      [
        'name' => 'response_type',
        'param' => 'response_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The OAuth flow to perform. Must be \'code\' (authorization code flow].',
      ],
      4 =>
      [
        'name' => 'redirect_uri',
        'param' => 'redirect_uri',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The URI the user should be redirected back to after granting consent to the app.',
      ],
      5 =>
      [
        'name' => 'client_id',
        'param' => 'client_id',
        'in' => 'query',
        'type' => 'string',
        'required' => true,
        'description' => 'The client_id of the OAuth app.',
      ],
      6 =>
      [
        'name' => 'state',
        'param' => 'state',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Unpredictable token to prevent CSRF.',
      ],
    ],
  ],
  91 =>
  [
    'operation' => 'oauth2.deauthorize.post',
    'slug' => 'dialpad_oauth2_deauthorize_post',
    'class' => 'DialpadOauth2DeauthorizePost',
    'method' => 'POST',
    'path' => '/oauth2/deauthorize',
    'name' => 'Token -- Deauthorize',
    'description' => 'Execute official Dialpad API operation `oauth2.deauthorize.post`.

Endpoint: POST /oauth2/deauthorize.',
    'type' => 'write',
    'tag' => 'oauth2',
    'parameters' =>
    [
    ],
  ],
  92 =>
  [
    'operation' => 'oauth2.token.post',
    'slug' => 'dialpad_oauth2_token_post',
    'class' => 'DialpadOauth2TokenPost',
    'method' => 'POST',
    'path' => '/oauth2/token',
    'name' => 'Token -- Redeem',
    'description' => 'Execute official Dialpad API operation `oauth2.token.post`.

Endpoint: POST /oauth2/token.',
    'type' => 'write',
    'tag' => 'oauth2',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  93 =>
  [
    'operation' => 'callcenters.list',
    'slug' => 'dialpad_callcenters_list',
    'class' => 'DialpadCallcentersList',
    'method' => 'GET',
    'path' => '/api/v2/offices/{office_id}/callcenters',
    'name' => 'Call Centers -- List',
    'description' => 'Execute official Dialpad API operation `callcenters.list`.

Endpoint: GET /api/v2/offices/{office_id}/callcenters.',
    'type' => 'read',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'office_id',
        'param' => 'office_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The office\'s id.',
      ],
    ],
  ],
  94 =>
  [
    'operation' => 'coaching_team.list',
    'slug' => 'dialpad_coaching_team_list',
    'class' => 'DialpadCoachingTeamList',
    'method' => 'GET',
    'path' => '/api/v2/offices/{office_id}/teams',
    'name' => 'Coaching Team -- List',
    'description' => 'Execute official Dialpad API operation `coaching_team.list`.

Endpoint: GET /api/v2/offices/{office_id}/teams.',
    'type' => 'read',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'office_id',
        'param' => 'office_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The office\'s id.',
      ],
    ],
  ],
  95 =>
  [
    'operation' => 'departments.list',
    'slug' => 'dialpad_departments_list',
    'class' => 'DialpadDepartmentsList',
    'method' => 'GET',
    'path' => '/api/v2/offices/{office_id}/departments',
    'name' => 'Department -- List',
    'description' => 'Execute official Dialpad API operation `departments.list`.

Endpoint: GET /api/v2/offices/{office_id}/departments.',
    'type' => 'read',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'office_id',
        'param' => 'office_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The office\'s id.',
      ],
    ],
  ],
  96 =>
  [
    'operation' => 'numbers.assign_office_number.post',
    'slug' => 'dialpad_numbers_assign_office_number_post',
    'class' => 'DialpadNumbersAssignOfficeNumberPost',
    'method' => 'POST',
    'path' => '/api/v2/offices/{id}/assign_number',
    'name' => 'Dialpad Number -- Assign',
    'description' => 'Execute official Dialpad API operation `numbers.assign_office_number.post`.

Endpoint: POST /api/v2/offices/{id}/assign_number.',
    'type' => 'write',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The office\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  97 =>
  [
    'operation' => 'numbers.office_unassign_number.post',
    'slug' => 'dialpad_numbers_office_unassign_number_post',
    'class' => 'DialpadNumbersOfficeUnassignNumberPost',
    'method' => 'POST',
    'path' => '/api/v2/offices/{id}/unassign_number',
    'name' => 'Dialpad Number -- Unassign',
    'description' => 'Execute official Dialpad API operation `numbers.office_unassign_number.post`.

Endpoint: POST /api/v2/offices/{id}/unassign_number.',
    'type' => 'write',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The office\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  98 =>
  [
    'operation' => 'offices.create',
    'slug' => 'dialpad_offices_create',
    'class' => 'DialpadOfficesCreate',
    'method' => 'POST',
    'path' => '/api/v2/offices',
    'name' => 'Office -- POST Creates a secondary office.',
    'description' => 'Execute official Dialpad API operation `offices.create`.

Endpoint: POST /api/v2/offices.',
    'type' => 'write',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  99 =>
  [
    'operation' => 'offices.e911.get',
    'slug' => 'dialpad_offices_e911_get',
    'class' => 'DialpadOfficesE911Get',
    'method' => 'GET',
    'path' => '/api/v2/offices/{id}/e911',
    'name' => 'E911 Address -- Get',
    'description' => 'Execute official Dialpad API operation `offices.e911.get`.

Endpoint: GET /api/v2/offices/{id}/e911.',
    'type' => 'read',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The office\'s id.',
      ],
    ],
  ],
  100 =>
  [
    'operation' => 'offices.e911.update',
    'slug' => 'dialpad_offices_e911_update',
    'class' => 'DialpadOfficesE911Update',
    'method' => 'PUT',
    'path' => '/api/v2/offices/{id}/e911',
    'name' => 'E911 Address -- Update',
    'description' => 'Execute official Dialpad API operation `offices.e911.update`.

Endpoint: PUT /api/v2/offices/{id}/e911.',
    'type' => 'write',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The office\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  101 =>
  [
    'operation' => 'offices.get',
    'slug' => 'dialpad_offices_get',
    'class' => 'DialpadOfficesGet',
    'method' => 'GET',
    'path' => '/api/v2/offices/{id}',
    'name' => 'Office -- Get',
    'description' => 'Execute official Dialpad API operation `offices.get`.

Endpoint: GET /api/v2/offices/{id}.',
    'type' => 'read',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The office\'s id.',
      ],
    ],
  ],
  102 =>
  [
    'operation' => 'offices.list',
    'slug' => 'dialpad_offices_list',
    'class' => 'DialpadOfficesList',
    'method' => 'GET',
    'path' => '/api/v2/offices',
    'name' => 'Office -- List',
    'description' => 'Execute official Dialpad API operation `offices.list`.

Endpoint: GET /api/v2/offices.',
    'type' => 'read',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'active_only',
        'param' => 'active_only',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'Whether we only return active offices.',
      ],
    ],
  ],
  103 =>
  [
    'operation' => 'offices.offdutystatuses.get',
    'slug' => 'dialpad_offices_offdutystatuses_get',
    'class' => 'DialpadOfficesOffdutystatusesGet',
    'method' => 'GET',
    'path' => '/api/v2/offices/{id}/offdutystatuses',
    'name' => 'Off-Duty Status -- List',
    'description' => 'Execute official Dialpad API operation `offices.offdutystatuses.get`.

Endpoint: GET /api/v2/offices/{id}/offdutystatuses.',
    'type' => 'read',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The office\'s id.',
      ],
    ],
  ],
  104 =>
  [
    'operation' => 'offices.operators.delete',
    'slug' => 'dialpad_offices_operators_delete',
    'class' => 'DialpadOfficesOperatorsDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/offices/{id}/operators',
    'name' => 'Operator -- Remove',
    'description' => 'Execute official Dialpad API operation `offices.operators.delete`.

Endpoint: DELETE /api/v2/offices/{id}/operators.',
    'type' => 'write',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The office\'s ID.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  105 =>
  [
    'operation' => 'offices.operators.get',
    'slug' => 'dialpad_offices_operators_get',
    'class' => 'DialpadOfficesOperatorsGet',
    'method' => 'GET',
    'path' => '/api/v2/offices/{id}/operators',
    'name' => 'Operator -- List',
    'description' => 'Execute official Dialpad API operation `offices.operators.get`.

Endpoint: GET /api/v2/offices/{id}/operators.',
    'type' => 'read',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The office\'s id.',
      ],
    ],
  ],
  106 =>
  [
    'operation' => 'offices.operators.post',
    'slug' => 'dialpad_offices_operators_post',
    'class' => 'DialpadOfficesOperatorsPost',
    'method' => 'POST',
    'path' => '/api/v2/offices/{id}/operators',
    'name' => 'Operator -- Add',
    'description' => 'Execute official Dialpad API operation `offices.operators.post`.

Endpoint: POST /api/v2/offices/{id}/operators.',
    'type' => 'write',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The office\'s ID.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  107 =>
  [
    'operation' => 'plan.available_licenses.get',
    'slug' => 'dialpad_plan_available_licenses_get',
    'class' => 'DialpadPlanAvailableLicensesGet',
    'method' => 'GET',
    'path' => '/api/v2/offices/{office_id}/available_licenses',
    'name' => 'Licenses -- List Available',
    'description' => 'Execute official Dialpad API operation `plan.available_licenses.get`.

Endpoint: GET /api/v2/offices/{office_id}/available_licenses.',
    'type' => 'read',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'office_id',
        'param' => 'office_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The office\'s id.',
      ],
    ],
  ],
  108 =>
  [
    'operation' => 'plan.get',
    'slug' => 'dialpad_plan_get',
    'class' => 'DialpadPlanGet',
    'method' => 'GET',
    'path' => '/api/v2/offices/{office_id}/plan',
    'name' => 'Billing Plan -- Get',
    'description' => 'Execute official Dialpad API operation `plan.get`.

Endpoint: GET /api/v2/offices/{office_id}/plan.',
    'type' => 'read',
    'tag' => 'offices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'office_id',
        'param' => 'office_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The office\'s id.',
      ],
    ],
  ],
  109 =>
  [
    'operation' => 'recording_share_link.create',
    'slug' => 'dialpad_recording_share_link_create',
    'class' => 'DialpadRecordingShareLinkCreate',
    'method' => 'POST',
    'path' => '/api/v2/recordingsharelink',
    'name' => 'Recording Sharelink -- Create',
    'description' => 'Execute official Dialpad API operation `recording_share_link.create`.

Endpoint: POST /api/v2/recordingsharelink.',
    'type' => 'write',
    'tag' => 'recordingsharelink',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  110 =>
  [
    'operation' => 'recording_share_link.delete',
    'slug' => 'dialpad_recording_share_link_delete',
    'class' => 'DialpadRecordingShareLinkDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/recordingsharelink/{id}',
    'name' => 'Recording Sharelink -- Delete',
    'description' => 'Execute official Dialpad API operation `recording_share_link.delete`.

Endpoint: DELETE /api/v2/recordingsharelink/{id}.',
    'type' => 'write',
    'tag' => 'recordingsharelink',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The recording share link\'s ID.',
      ],
    ],
  ],
  111 =>
  [
    'operation' => 'recording_share_link.get',
    'slug' => 'dialpad_recording_share_link_get',
    'class' => 'DialpadRecordingShareLinkGet',
    'method' => 'GET',
    'path' => '/api/v2/recordingsharelink/{id}',
    'name' => 'Recording Sharelink -- Get',
    'description' => 'Execute official Dialpad API operation `recording_share_link.get`.

Endpoint: GET /api/v2/recordingsharelink/{id}.',
    'type' => 'read',
    'tag' => 'recordingsharelink',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The recording share link\'s ID.',
      ],
    ],
  ],
  112 =>
  [
    'operation' => 'recording_share_link.update',
    'slug' => 'dialpad_recording_share_link_update',
    'class' => 'DialpadRecordingShareLinkUpdate',
    'method' => 'PUT',
    'path' => '/api/v2/recordingsharelink/{id}',
    'name' => 'Recording Sharelink -- Update',
    'description' => 'Execute official Dialpad API operation `recording_share_link.update`.

Endpoint: PUT /api/v2/recordingsharelink/{id}.',
    'type' => 'write',
    'tag' => 'recordingsharelink',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The recording share link\'s ID.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  113 =>
  [
    'operation' => 'deskphones.rooms.create_international_pin',
    'slug' => 'dialpad_deskphones_rooms_create_international_pin',
    'class' => 'DialpadDeskphonesRoomsCreateInternationalPin',
    'method' => 'POST',
    'path' => '/api/v2/rooms/international_pin',
    'name' => 'Room Phone -- Assign PIN',
    'description' => 'Execute official Dialpad API operation `deskphones.rooms.create_international_pin`.

Endpoint: POST /api/v2/rooms/international_pin.',
    'type' => 'write',
    'tag' => 'rooms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  114 =>
  [
    'operation' => 'deskphones.rooms.delete',
    'slug' => 'dialpad_deskphones_rooms_delete',
    'class' => 'DialpadDeskphonesRoomsDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/rooms/{parent_id}/deskphones/{id}',
    'name' => 'Room Phone -- Delete',
    'description' => 'Execute official Dialpad API operation `deskphones.rooms.delete`.

Endpoint: DELETE /api/v2/rooms/{parent_id}/deskphones/{id}.',
    'type' => 'write',
    'tag' => 'rooms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The desk phone\'s id.',
      ],
      1 =>
      [
        'name' => 'parent_id',
        'param' => 'parent_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The room\'s id.',
      ],
    ],
  ],
  115 =>
  [
    'operation' => 'deskphones.rooms.get',
    'slug' => 'dialpad_deskphones_rooms_get',
    'class' => 'DialpadDeskphonesRoomsGet',
    'method' => 'GET',
    'path' => '/api/v2/rooms/{parent_id}/deskphones/{id}',
    'name' => 'Room Phone -- Get',
    'description' => 'Execute official Dialpad API operation `deskphones.rooms.get`.

Endpoint: GET /api/v2/rooms/{parent_id}/deskphones/{id}.',
    'type' => 'read',
    'tag' => 'rooms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The desk phone\'s id.',
      ],
      1 =>
      [
        'name' => 'parent_id',
        'param' => 'parent_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The room\'s id.',
      ],
    ],
  ],
  116 =>
  [
    'operation' => 'deskphones.rooms.list',
    'slug' => 'dialpad_deskphones_rooms_list',
    'class' => 'DialpadDeskphonesRoomsList',
    'method' => 'GET',
    'path' => '/api/v2/rooms/{parent_id}/deskphones',
    'name' => 'Room Phone -- List',
    'description' => 'Execute official Dialpad API operation `deskphones.rooms.list`.

Endpoint: GET /api/v2/rooms/{parent_id}/deskphones.',
    'type' => 'read',
    'tag' => 'rooms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'parent_id',
        'param' => 'parent_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The room\'s id.',
      ],
    ],
  ],
  117 =>
  [
    'operation' => 'numbers.assign_room_number.post',
    'slug' => 'dialpad_numbers_assign_room_number_post',
    'class' => 'DialpadNumbersAssignRoomNumberPost',
    'method' => 'POST',
    'path' => '/api/v2/rooms/{id}/assign_number',
    'name' => 'Dialpad Number -- Assign',
    'description' => 'Execute official Dialpad API operation `numbers.assign_room_number.post`.

Endpoint: POST /api/v2/rooms/{id}/assign_number.',
    'type' => 'write',
    'tag' => 'rooms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The room\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  118 =>
  [
    'operation' => 'numbers.room_unassign_number.post',
    'slug' => 'dialpad_numbers_room_unassign_number_post',
    'class' => 'DialpadNumbersRoomUnassignNumberPost',
    'method' => 'POST',
    'path' => '/api/v2/rooms/{id}/unassign_number',
    'name' => 'Dialpad Number -- Unassign',
    'description' => 'Execute official Dialpad API operation `numbers.room_unassign_number.post`.

Endpoint: POST /api/v2/rooms/{id}/unassign_number.',
    'type' => 'write',
    'tag' => 'rooms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The room\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  119 =>
  [
    'operation' => 'rooms.delete',
    'slug' => 'dialpad_rooms_delete',
    'class' => 'DialpadRoomsDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/rooms/{id}',
    'name' => 'Room -- Delete',
    'description' => 'Execute official Dialpad API operation `rooms.delete`.

Endpoint: DELETE /api/v2/rooms/{id}.',
    'type' => 'write',
    'tag' => 'rooms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The room\'s id.',
      ],
    ],
  ],
  120 =>
  [
    'operation' => 'rooms.get',
    'slug' => 'dialpad_rooms_get',
    'class' => 'DialpadRoomsGet',
    'method' => 'GET',
    'path' => '/api/v2/rooms/{id}',
    'name' => 'Room -- Get',
    'description' => 'Execute official Dialpad API operation `rooms.get`.

Endpoint: GET /api/v2/rooms/{id}.',
    'type' => 'read',
    'tag' => 'rooms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The room\'s id.',
      ],
    ],
  ],
  121 =>
  [
    'operation' => 'rooms.list',
    'slug' => 'dialpad_rooms_list',
    'class' => 'DialpadRoomsList',
    'method' => 'GET',
    'path' => '/api/v2/rooms',
    'name' => 'Room -- List',
    'description' => 'Execute official Dialpad API operation `rooms.list`.

Endpoint: GET /api/v2/rooms.',
    'type' => 'read',
    'tag' => 'rooms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'office_id',
        'param' => 'office_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The office\'s id.',
      ],
    ],
  ],
  122 =>
  [
    'operation' => 'rooms.patch',
    'slug' => 'dialpad_rooms_patch',
    'class' => 'DialpadRoomsPatch',
    'method' => 'PATCH',
    'path' => '/api/v2/rooms/{id}',
    'name' => 'Room -- Update',
    'description' => 'Execute official Dialpad API operation `rooms.patch`.

Endpoint: PATCH /api/v2/rooms/{id}.',
    'type' => 'write',
    'tag' => 'rooms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The room\'s id.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  123 =>
  [
    'operation' => 'rooms.post',
    'slug' => 'dialpad_rooms_post',
    'class' => 'DialpadRoomsPost',
    'method' => 'POST',
    'path' => '/api/v2/rooms',
    'name' => 'Room -- Create',
    'description' => 'Execute official Dialpad API operation `rooms.post`.

Endpoint: POST /api/v2/rooms.',
    'type' => 'write',
    'tag' => 'rooms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  124 =>
  [
    'operation' => 'schedule_reports.create',
    'slug' => 'dialpad_schedule_reports_create',
    'class' => 'DialpadScheduleReportsCreate',
    'method' => 'POST',
    'path' => '/api/v2/schedulereports',
    'name' => 'schedule reports -- Create',
    'description' => 'Execute official Dialpad API operation `schedule_reports.create`.

Endpoint: POST /api/v2/schedulereports.',
    'type' => 'write',
    'tag' => 'schedulereports',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  125 =>
  [
    'operation' => 'schedule_reports.delete',
    'slug' => 'dialpad_schedule_reports_delete',
    'class' => 'DialpadScheduleReportsDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/schedulereports/{id}',
    'name' => 'Schedule reports -- Delete',
    'description' => 'Execute official Dialpad API operation `schedule_reports.delete`.

Endpoint: DELETE /api/v2/schedulereports/{id}.',
    'type' => 'write',
    'tag' => 'schedulereports',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The schedule reports subscription\'s ID.',
      ],
    ],
  ],
  126 =>
  [
    'operation' => 'schedule_reports.get',
    'slug' => 'dialpad_schedule_reports_get',
    'class' => 'DialpadScheduleReportsGet',
    'method' => 'GET',
    'path' => '/api/v2/schedulereports/{id}',
    'name' => 'Schedule reports -- Get',
    'description' => 'Execute official Dialpad API operation `schedule_reports.get`.

Endpoint: GET /api/v2/schedulereports/{id}.',
    'type' => 'read',
    'tag' => 'schedulereports',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The schedule reports subscription\'s ID.',
      ],
    ],
  ],
  127 =>
  [
    'operation' => 'schedule_reports.list',
    'slug' => 'dialpad_schedule_reports_list',
    'class' => 'DialpadScheduleReportsList',
    'method' => 'GET',
    'path' => '/api/v2/schedulereports',
    'name' => 'Schedule reports -- List',
    'description' => 'Execute official Dialpad API operation `schedule_reports.list`.

Endpoint: GET /api/v2/schedulereports.',
    'type' => 'read',
    'tag' => 'schedulereports',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
    ],
  ],
  128 =>
  [
    'operation' => 'schedule_reports.update',
    'slug' => 'dialpad_schedule_reports_update',
    'class' => 'DialpadScheduleReportsUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/schedulereports/{id}',
    'name' => 'Schedule reports -- Update',
    'description' => 'Execute official Dialpad API operation `schedule_reports.update`.

Endpoint: PATCH /api/v2/schedulereports/{id}.',
    'type' => 'write',
    'tag' => 'schedulereports',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The schedule reports subscription\'s ID.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  129 =>
  [
    'operation' => 'sms.send',
    'slug' => 'dialpad_sms_send',
    'class' => 'DialpadSmsSend',
    'method' => 'POST',
    'path' => '/api/v2/sms',
    'name' => 'SMS -- Send',
    'description' => 'Execute official Dialpad API operation `sms.send`.

Endpoint: POST /api/v2/sms.',
    'type' => 'write',
    'tag' => 'sms',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  130 =>
  [
    'operation' => 'stats.create',
    'slug' => 'dialpad_stats_create',
    'class' => 'DialpadStatsCreate',
    'method' => 'POST',
    'path' => '/api/v2/stats',
    'name' => 'Stats -- Initiate Processing',
    'description' => 'Execute official Dialpad API operation `stats.create`.

Endpoint: POST /api/v2/stats.',
    'type' => 'write',
    'tag' => 'stats',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  131 =>
  [
    'operation' => 'stats.get',
    'slug' => 'dialpad_stats_get',
    'class' => 'DialpadStatsGet',
    'method' => 'GET',
    'path' => '/api/v2/stats/{id}',
    'name' => 'Stats -- Get Result',
    'description' => 'Execute official Dialpad API operation `stats.get`.

Endpoint: GET /api/v2/stats/{id}.',
    'type' => 'read',
    'tag' => 'stats',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'Request ID returned by a POST /stats request.',
      ],
    ],
  ],
  132 =>
  [
    'operation' => 'webhook_agent_status_event_subscription.create',
    'slug' => 'dialpad_webhook_agent_status_event_subscription_create',
    'class' => 'DialpadWebhookAgentStatusEventSubscriptionCreate',
    'method' => 'POST',
    'path' => '/api/v2/subscriptions/agent_status',
    'name' => 'Agent Status -- Create',
    'description' => 'Execute official Dialpad API operation `webhook_agent_status_event_subscription.create`.

Endpoint: POST /api/v2/subscriptions/agent_status.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  133 =>
  [
    'operation' => 'webhook_agent_status_event_subscription.delete',
    'slug' => 'dialpad_webhook_agent_status_event_subscription_delete',
    'class' => 'DialpadWebhookAgentStatusEventSubscriptionDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/subscriptions/agent_status/{id}',
    'name' => 'Agent Status -- Delete',
    'description' => 'Execute official Dialpad API operation `webhook_agent_status_event_subscription.delete`.

Endpoint: DELETE /api/v2/subscriptions/agent_status/{id}.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
    ],
  ],
  134 =>
  [
    'operation' => 'webhook_agent_status_event_subscription.get',
    'slug' => 'dialpad_webhook_agent_status_event_subscription_get',
    'class' => 'DialpadWebhookAgentStatusEventSubscriptionGet',
    'method' => 'GET',
    'path' => '/api/v2/subscriptions/agent_status/{id}',
    'name' => 'Agent Status -- Get',
    'description' => 'Execute official Dialpad API operation `webhook_agent_status_event_subscription.get`.

Endpoint: GET /api/v2/subscriptions/agent_status/{id}.',
    'type' => 'read',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
    ],
  ],
  135 =>
  [
    'operation' => 'webhook_agent_status_event_subscription.list',
    'slug' => 'dialpad_webhook_agent_status_event_subscription_list',
    'class' => 'DialpadWebhookAgentStatusEventSubscriptionList',
    'method' => 'GET',
    'path' => '/api/v2/subscriptions/agent_status',
    'name' => 'Agent Status -- List',
    'description' => 'Execute official Dialpad API operation `webhook_agent_status_event_subscription.list`.

Endpoint: GET /api/v2/subscriptions/agent_status.',
    'type' => 'read',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
    ],
  ],
  136 =>
  [
    'operation' => 'webhook_agent_status_event_subscription.update',
    'slug' => 'dialpad_webhook_agent_status_event_subscription_update',
    'class' => 'DialpadWebhookAgentStatusEventSubscriptionUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/subscriptions/agent_status/{id}',
    'name' => 'Agent Status -- Update',
    'description' => 'Execute official Dialpad API operation `webhook_agent_status_event_subscription.update`.

Endpoint: PATCH /api/v2/subscriptions/agent_status/{id}.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  137 =>
  [
    'operation' => 'webhook_call_event_subscription.create',
    'slug' => 'dialpad_webhook_call_event_subscription_create',
    'class' => 'DialpadWebhookCallEventSubscriptionCreate',
    'method' => 'POST',
    'path' => '/api/v2/subscriptions/call',
    'name' => 'Call Event -- Create',
    'description' => 'Execute official Dialpad API operation `webhook_call_event_subscription.create`.

Endpoint: POST /api/v2/subscriptions/call.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  138 =>
  [
    'operation' => 'webhook_call_event_subscription.delete',
    'slug' => 'dialpad_webhook_call_event_subscription_delete',
    'class' => 'DialpadWebhookCallEventSubscriptionDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/subscriptions/call/{id}',
    'name' => 'Call Event -- Delete',
    'description' => 'Execute official Dialpad API operation `webhook_call_event_subscription.delete`.

Endpoint: DELETE /api/v2/subscriptions/call/{id}.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
    ],
  ],
  139 =>
  [
    'operation' => 'webhook_call_event_subscription.get',
    'slug' => 'dialpad_webhook_call_event_subscription_get',
    'class' => 'DialpadWebhookCallEventSubscriptionGet',
    'method' => 'GET',
    'path' => '/api/v2/subscriptions/call/{id}',
    'name' => 'Call Event -- Get',
    'description' => 'Execute official Dialpad API operation `webhook_call_event_subscription.get`.

Endpoint: GET /api/v2/subscriptions/call/{id}.',
    'type' => 'read',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
    ],
  ],
  140 =>
  [
    'operation' => 'webhook_call_event_subscription.list',
    'slug' => 'dialpad_webhook_call_event_subscription_list',
    'class' => 'DialpadWebhookCallEventSubscriptionList',
    'method' => 'GET',
    'path' => '/api/v2/subscriptions/call',
    'name' => 'Call Event -- List',
    'description' => 'Execute official Dialpad API operation `webhook_call_event_subscription.list`.

Endpoint: GET /api/v2/subscriptions/call.',
    'type' => 'read',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'target_type',
        'param' => 'target_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Target\'s type.',
      ],
      2 =>
      [
        'name' => 'target_id',
        'param' => 'target_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The target\'s id.',
      ],
    ],
  ],
  141 =>
  [
    'operation' => 'webhook_call_event_subscription.update',
    'slug' => 'dialpad_webhook_call_event_subscription_update',
    'class' => 'DialpadWebhookCallEventSubscriptionUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/subscriptions/call/{id}',
    'name' => 'Call Event -- Update',
    'description' => 'Execute official Dialpad API operation `webhook_call_event_subscription.update`.

Endpoint: PATCH /api/v2/subscriptions/call/{id}.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  142 =>
  [
    'operation' => 'webhook_change_log_event_subscription.create',
    'slug' => 'dialpad_webhook_change_log_event_subscription_create',
    'class' => 'DialpadWebhookChangeLogEventSubscriptionCreate',
    'method' => 'POST',
    'path' => '/api/v2/subscriptions/changelog',
    'name' => 'Change Log -- Create',
    'description' => 'Execute official Dialpad API operation `webhook_change_log_event_subscription.create`.

Endpoint: POST /api/v2/subscriptions/changelog.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  143 =>
  [
    'operation' => 'webhook_change_log_event_subscription.delete',
    'slug' => 'dialpad_webhook_change_log_event_subscription_delete',
    'class' => 'DialpadWebhookChangeLogEventSubscriptionDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/subscriptions/changelog/{id}',
    'name' => 'Change Log -- Delete',
    'description' => 'Execute official Dialpad API operation `webhook_change_log_event_subscription.delete`.

Endpoint: DELETE /api/v2/subscriptions/changelog/{id}.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
    ],
  ],
  144 =>
  [
    'operation' => 'webhook_change_log_event_subscription.get',
    'slug' => 'dialpad_webhook_change_log_event_subscription_get',
    'class' => 'DialpadWebhookChangeLogEventSubscriptionGet',
    'method' => 'GET',
    'path' => '/api/v2/subscriptions/changelog/{id}',
    'name' => 'Change Log -- Get',
    'description' => 'Execute official Dialpad API operation `webhook_change_log_event_subscription.get`.

Endpoint: GET /api/v2/subscriptions/changelog/{id}.',
    'type' => 'read',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
    ],
  ],
  145 =>
  [
    'operation' => 'webhook_change_log_event_subscription.list',
    'slug' => 'dialpad_webhook_change_log_event_subscription_list',
    'class' => 'DialpadWebhookChangeLogEventSubscriptionList',
    'method' => 'GET',
    'path' => '/api/v2/subscriptions/changelog',
    'name' => 'Change Log -- List',
    'description' => 'Execute official Dialpad API operation `webhook_change_log_event_subscription.list`.

Endpoint: GET /api/v2/subscriptions/changelog.',
    'type' => 'read',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
    ],
  ],
  146 =>
  [
    'operation' => 'webhook_change_log_event_subscription.update',
    'slug' => 'dialpad_webhook_change_log_event_subscription_update',
    'class' => 'DialpadWebhookChangeLogEventSubscriptionUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/subscriptions/changelog/{id}',
    'name' => 'Change Log -- Update',
    'description' => 'Execute official Dialpad API operation `webhook_change_log_event_subscription.update`.

Endpoint: PATCH /api/v2/subscriptions/changelog/{id}.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  147 =>
  [
    'operation' => 'webhook_contact_event_subscription.create',
    'slug' => 'dialpad_webhook_contact_event_subscription_create',
    'class' => 'DialpadWebhookContactEventSubscriptionCreate',
    'method' => 'POST',
    'path' => '/api/v2/subscriptions/contact',
    'name' => 'Contact Event -- Create',
    'description' => 'Execute official Dialpad API operation `webhook_contact_event_subscription.create`.

Endpoint: POST /api/v2/subscriptions/contact.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  148 =>
  [
    'operation' => 'webhook_contact_event_subscription.delete',
    'slug' => 'dialpad_webhook_contact_event_subscription_delete',
    'class' => 'DialpadWebhookContactEventSubscriptionDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/subscriptions/contact/{id}',
    'name' => 'Contact Event -- Delete',
    'description' => 'Execute official Dialpad API operation `webhook_contact_event_subscription.delete`.

Endpoint: DELETE /api/v2/subscriptions/contact/{id}.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
    ],
  ],
  149 =>
  [
    'operation' => 'webhook_contact_event_subscription.get',
    'slug' => 'dialpad_webhook_contact_event_subscription_get',
    'class' => 'DialpadWebhookContactEventSubscriptionGet',
    'method' => 'GET',
    'path' => '/api/v2/subscriptions/contact/{id}',
    'name' => 'Contact Event -- Get',
    'description' => 'Execute official Dialpad API operation `webhook_contact_event_subscription.get`.

Endpoint: GET /api/v2/subscriptions/contact/{id}.',
    'type' => 'read',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
    ],
  ],
  150 =>
  [
    'operation' => 'webhook_contact_event_subscription.list',
    'slug' => 'dialpad_webhook_contact_event_subscription_list',
    'class' => 'DialpadWebhookContactEventSubscriptionList',
    'method' => 'GET',
    'path' => '/api/v2/subscriptions/contact',
    'name' => 'Contact Event -- List',
    'description' => 'Execute official Dialpad API operation `webhook_contact_event_subscription.list`.

Endpoint: GET /api/v2/subscriptions/contact.',
    'type' => 'read',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
    ],
  ],
  151 =>
  [
    'operation' => 'webhook_contact_event_subscription.update',
    'slug' => 'dialpad_webhook_contact_event_subscription_update',
    'class' => 'DialpadWebhookContactEventSubscriptionUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/subscriptions/contact/{id}',
    'name' => 'Contact Event -- Update',
    'description' => 'Execute official Dialpad API operation `webhook_contact_event_subscription.update`.

Endpoint: PATCH /api/v2/subscriptions/contact/{id}.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  152 =>
  [
    'operation' => 'webhook_sms_event_subscription.create',
    'slug' => 'dialpad_webhook_sms_event_subscription_create',
    'class' => 'DialpadWebhookSmsEventSubscriptionCreate',
    'method' => 'POST',
    'path' => '/api/v2/subscriptions/sms',
    'name' => 'SMS Event -- Create',
    'description' => 'Execute official Dialpad API operation `webhook_sms_event_subscription.create`.

Endpoint: POST /api/v2/subscriptions/sms.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  153 =>
  [
    'operation' => 'webhook_sms_event_subscription.delete',
    'slug' => 'dialpad_webhook_sms_event_subscription_delete',
    'class' => 'DialpadWebhookSmsEventSubscriptionDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/subscriptions/sms/{id}',
    'name' => 'SMS Event -- Delete',
    'description' => 'Execute official Dialpad API operation `webhook_sms_event_subscription.delete`.

Endpoint: DELETE /api/v2/subscriptions/sms/{id}.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
    ],
  ],
  154 =>
  [
    'operation' => 'webhook_sms_event_subscription.get',
    'slug' => 'dialpad_webhook_sms_event_subscription_get',
    'class' => 'DialpadWebhookSmsEventSubscriptionGet',
    'method' => 'GET',
    'path' => '/api/v2/subscriptions/sms/{id}',
    'name' => 'SMS Event -- Get',
    'description' => 'Execute official Dialpad API operation `webhook_sms_event_subscription.get`.

Endpoint: GET /api/v2/subscriptions/sms/{id}.',
    'type' => 'read',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
    ],
  ],
  155 =>
  [
    'operation' => 'webhook_sms_event_subscription.list',
    'slug' => 'dialpad_webhook_sms_event_subscription_list',
    'class' => 'DialpadWebhookSmsEventSubscriptionList',
    'method' => 'GET',
    'path' => '/api/v2/subscriptions/sms',
    'name' => 'SMS Event -- List',
    'description' => 'Execute official Dialpad API operation `webhook_sms_event_subscription.list`.

Endpoint: GET /api/v2/subscriptions/sms.',
    'type' => 'read',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'target_type',
        'param' => 'target_type',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Target\'s type.',
      ],
      2 =>
      [
        'name' => 'target_id',
        'param' => 'target_id',
        'in' => 'query',
        'type' => 'integer',
        'required' => false,
        'description' => 'The target\'s id.',
      ],
    ],
  ],
  156 =>
  [
    'operation' => 'webhook_sms_event_subscription.update',
    'slug' => 'dialpad_webhook_sms_event_subscription_update',
    'class' => 'DialpadWebhookSmsEventSubscriptionUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/subscriptions/sms/{id}',
    'name' => 'SMS Event -- Update',
    'description' => 'Execute official Dialpad API operation `webhook_sms_event_subscription.update`.

Endpoint: PATCH /api/v2/subscriptions/sms/{id}.',
    'type' => 'write',
    'tag' => 'subscriptions',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The event subscription\'s ID, which is generated after creating an event subscription successfully.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  157 =>
  [
    'operation' => 'transcripts.get',
    'slug' => 'dialpad_transcripts_get',
    'class' => 'DialpadTranscriptsGet',
    'method' => 'GET',
    'path' => '/api/v2/transcripts/{call_id}',
    'name' => 'Call Transcript -- Get',
    'description' => 'Execute official Dialpad API operation `transcripts.get`.

Endpoint: GET /api/v2/transcripts/{call_id}.',
    'type' => 'read',
    'tag' => 'transcripts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'call_id',
        'param' => 'call_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call\'s id.',
      ],
    ],
  ],
  158 =>
  [
    'operation' => 'transcripts.get_url',
    'slug' => 'dialpad_transcripts_get_url',
    'class' => 'DialpadTranscriptsGetUrl',
    'method' => 'GET',
    'path' => '/api/v2/transcripts/{call_id}/url',
    'name' => 'Call Transcript -- Get URL',
    'description' => 'Execute official Dialpad API operation `transcripts.get_url`.

Endpoint: GET /api/v2/transcripts/{call_id}/url.',
    'type' => 'read',
    'tag' => 'transcripts',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'call_id',
        'param' => 'call_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The call\'s id.',
      ],
    ],
  ],
  159 =>
  [
    'operation' => 'userdevices.get',
    'slug' => 'dialpad_userdevices_get',
    'class' => 'DialpadUserdevicesGet',
    'method' => 'GET',
    'path' => '/api/v2/userdevices/{id}',
    'name' => 'User Device -- Get',
    'description' => 'Execute official Dialpad API operation `userdevices.get`.

Endpoint: GET /api/v2/userdevices/{id}.',
    'type' => 'read',
    'tag' => 'userdevices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The device\'s id.',
      ],
    ],
  ],
  160 =>
  [
    'operation' => 'userdevices.list',
    'slug' => 'dialpad_userdevices_list',
    'class' => 'DialpadUserdevicesList',
    'method' => 'GET',
    'path' => '/api/v2/userdevices',
    'name' => 'User Device -- List',
    'description' => 'Execute official Dialpad API operation `userdevices.list`.

Endpoint: GET /api/v2/userdevices.',
    'type' => 'read',
    'tag' => 'userdevices',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'user_id',
        'param' => 'user_id',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
    ],
  ],
  161 =>
  [
    'operation' => 'caller_id.users.get',
    'slug' => 'dialpad_caller_id_users_get',
    'class' => 'DialpadCallerIdUsersGet',
    'method' => 'GET',
    'path' => '/api/v2/users/{id}/caller_id',
    'name' => 'Caller ID -- Get',
    'description' => 'Execute official Dialpad API operation `caller_id.users.get`.

Endpoint: GET /api/v2/users/{id}/caller_id.',
    'type' => 'read',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
    ],
  ],
  162 =>
  [
    'operation' => 'caller_id.users.post',
    'slug' => 'dialpad_caller_id_users_post',
    'class' => 'DialpadCallerIdUsersPost',
    'method' => 'POST',
    'path' => '/api/v2/users/{id}/caller_id',
    'name' => 'Caller ID -- POST',
    'description' => 'Execute official Dialpad API operation `caller_id.users.post`.

Endpoint: POST /api/v2/users/{id}/caller_id.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  163 =>
  [
    'operation' => 'deskphones.users.delete',
    'slug' => 'dialpad_deskphones_users_delete',
    'class' => 'DialpadDeskphonesUsersDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/users/{parent_id}/deskphones/{id}',
    'name' => 'Desk Phone -- Delete',
    'description' => 'Execute official Dialpad API operation `deskphones.users.delete`.

Endpoint: DELETE /api/v2/users/{parent_id}/deskphones/{id}.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The desk phone\'s id.',
      ],
      1 =>
      [
        'name' => 'parent_id',
        'param' => 'parent_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
    ],
  ],
  164 =>
  [
    'operation' => 'deskphones.users.get',
    'slug' => 'dialpad_deskphones_users_get',
    'class' => 'DialpadDeskphonesUsersGet',
    'method' => 'GET',
    'path' => '/api/v2/users/{parent_id}/deskphones/{id}',
    'name' => 'Desk Phone -- Get',
    'description' => 'Execute official Dialpad API operation `deskphones.users.get`.

Endpoint: GET /api/v2/users/{parent_id}/deskphones/{id}.',
    'type' => 'read',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The desk phone\'s id.',
      ],
      1 =>
      [
        'name' => 'parent_id',
        'param' => 'parent_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
    ],
  ],
  165 =>
  [
    'operation' => 'deskphones.users.list',
    'slug' => 'dialpad_deskphones_users_list',
    'class' => 'DialpadDeskphonesUsersList',
    'method' => 'GET',
    'path' => '/api/v2/users/{parent_id}/deskphones',
    'name' => 'Desk Phone -- List',
    'description' => 'Execute official Dialpad API operation `deskphones.users.list`.

Endpoint: GET /api/v2/users/{parent_id}/deskphones.',
    'type' => 'read',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'parent_id',
        'param' => 'parent_id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
    ],
  ],
  166 =>
  [
    'operation' => 'numbers.assign_user_number.post',
    'slug' => 'dialpad_numbers_assign_user_number_post',
    'class' => 'DialpadNumbersAssignUserNumberPost',
    'method' => 'POST',
    'path' => '/api/v2/users/{id}/assign_number',
    'name' => 'Dialpad Number -- Assign',
    'description' => 'Execute official Dialpad API operation `numbers.assign_user_number.post`.

Endpoint: POST /api/v2/users/{id}/assign_number.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  167 =>
  [
    'operation' => 'numbers.user_unassign_number.post',
    'slug' => 'dialpad_numbers_user_unassign_number_post',
    'class' => 'DialpadNumbersUserUnassignNumberPost',
    'method' => 'POST',
    'path' => '/api/v2/users/{id}/unassign_number',
    'name' => 'Dialpad Number -- Unassign',
    'description' => 'Execute official Dialpad API operation `numbers.user_unassign_number.post`.

Endpoint: POST /api/v2/users/{id}/unassign_number.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  168 =>
  [
    'operation' => 'screen_pop.initiate',
    'slug' => 'dialpad_screen_pop_initiate',
    'class' => 'DialpadScreenPopInitiate',
    'method' => 'POST',
    'path' => '/api/v2/users/{id}/screenpop',
    'name' => 'Screen-pop -- Trigger',
    'description' => 'Execute official Dialpad API operation `screen_pop.initiate`.

Endpoint: POST /api/v2/users/{id}/screenpop.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  169 =>
  [
    'operation' => 'users.create',
    'slug' => 'dialpad_users_create',
    'class' => 'DialpadUsersCreate',
    'method' => 'POST',
    'path' => '/api/v2/users',
    'name' => 'User -- Create',
    'description' => 'Execute official Dialpad API operation `users.create`.

Endpoint: POST /api/v2/users.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  170 =>
  [
    'operation' => 'users.delete',
    'slug' => 'dialpad_users_delete',
    'class' => 'DialpadUsersDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/users/{id}',
    'name' => 'User -- Delete',
    'description' => 'Execute official Dialpad API operation `users.delete`.

Endpoint: DELETE /api/v2/users/{id}.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
    ],
  ],
  171 =>
  [
    'operation' => 'users.e911.get',
    'slug' => 'dialpad_users_e911_get',
    'class' => 'DialpadUsersE911Get',
    'method' => 'GET',
    'path' => '/api/v2/users/{id}/e911',
    'name' => 'E911 Address -- Get',
    'description' => 'Execute official Dialpad API operation `users.e911.get`.

Endpoint: GET /api/v2/users/{id}/e911.',
    'type' => 'read',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
    ],
  ],
  172 =>
  [
    'operation' => 'users.e911.update',
    'slug' => 'dialpad_users_e911_update',
    'class' => 'DialpadUsersE911Update',
    'method' => 'PUT',
    'path' => '/api/v2/users/{id}/e911',
    'name' => 'E911 Address -- Update',
    'description' => 'Execute official Dialpad API operation `users.e911.update`.

Endpoint: PUT /api/v2/users/{id}/e911.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  173 =>
  [
    'operation' => 'users.get',
    'slug' => 'dialpad_users_get',
    'class' => 'DialpadUsersGet',
    'method' => 'GET',
    'path' => '/api/v2/users/{id}',
    'name' => 'User -- Get',
    'description' => 'Execute official Dialpad API operation `users.get`.

Endpoint: GET /api/v2/users/{id}.',
    'type' => 'read',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
    ],
  ],
  174 =>
  [
    'operation' => 'users.initiate_call',
    'slug' => 'dialpad_users_initiate_call',
    'class' => 'DialpadUsersInitiateCall',
    'method' => 'POST',
    'path' => '/api/v2/users/{id}/initiate_call',
    'name' => 'Call -- Initiate',
    'description' => 'Execute official Dialpad API operation `users.initiate_call`.

Endpoint: POST /api/v2/users/{id}/initiate_call.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  175 =>
  [
    'operation' => 'users.list',
    'slug' => 'dialpad_users_list',
    'class' => 'DialpadUsersList',
    'method' => 'GET',
    'path' => '/api/v2/users',
    'name' => 'User -- List',
    'description' => 'Execute official Dialpad API operation `users.list`.

Endpoint: GET /api/v2/users.',
    'type' => 'read',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
      1 =>
      [
        'name' => 'state',
        'param' => 'state',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'Filter results by the specified user state (e.g. active, suspended, deleted]',
      ],
      2 =>
      [
        'name' => 'company_admin',
        'param' => 'company_admin',
        'in' => 'query',
        'type' => 'boolean',
        'required' => false,
        'description' => 'If provided, filter results by the specified value to return only company admins or only non-company admins.',
      ],
      3 =>
      [
        'name' => 'email',
        'param' => 'email',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The user\'s email.',
      ],
      4 =>
      [
        'name' => 'number',
        'param' => 'number',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'The user\'s phone number.',
      ],
    ],
  ],
  176 =>
  [
    'operation' => 'users.move_office.patch',
    'slug' => 'dialpad_users_move_office_patch',
    'class' => 'DialpadUsersMoveOfficePatch',
    'method' => 'PATCH',
    'path' => '/api/v2/users/{id}/move_office',
    'name' => 'User -- Switch Office',
    'description' => 'Execute official Dialpad API operation `users.move_office.patch`.

Endpoint: PATCH /api/v2/users/{id}/move_office.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  177 =>
  [
    'operation' => 'users.personas.get',
    'slug' => 'dialpad_users_personas_get',
    'class' => 'DialpadUsersPersonasGet',
    'method' => 'GET',
    'path' => '/api/v2/users/{id}/personas',
    'name' => 'Persona -- List',
    'description' => 'Execute official Dialpad API operation `users.personas.get`.

Endpoint: GET /api/v2/users/{id}/personas.',
    'type' => 'read',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
    ],
  ],
  178 =>
  [
    'operation' => 'users.toggle_call_vi',
    'slug' => 'dialpad_users_toggle_call_vi',
    'class' => 'DialpadUsersToggleCallVi',
    'method' => 'PATCH',
    'path' => '/api/v2/users/{id}/togglevi',
    'name' => 'Call VI -- Toggle',
    'description' => 'Execute official Dialpad API operation `users.toggle_call_vi`.

Endpoint: PATCH /api/v2/users/{id}/togglevi.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  179 =>
  [
    'operation' => 'users.toggle_dnd',
    'slug' => 'dialpad_users_toggle_dnd',
    'class' => 'DialpadUsersToggleDnd',
    'method' => 'PATCH',
    'path' => '/api/v2/users/{id}/togglednd',
    'name' => 'Do Not Disturb -- Toggle',
    'description' => 'Execute official Dialpad API operation `users.toggle_dnd`.

Endpoint: PATCH /api/v2/users/{id}/togglednd.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  180 =>
  [
    'operation' => 'users.update',
    'slug' => 'dialpad_users_update',
    'class' => 'DialpadUsersUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/users/{id}',
    'name' => 'User -- Update',
    'description' => 'Execute official Dialpad API operation `users.update`.

Endpoint: PATCH /api/v2/users/{id}.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  181 =>
  [
    'operation' => 'users.update_active_call',
    'slug' => 'dialpad_users_update_active_call',
    'class' => 'DialpadUsersUpdateActiveCall',
    'method' => 'PATCH',
    'path' => '/api/v2/users/{id}/activecall',
    'name' => 'Call Recording -- Toggle',
    'description' => 'Execute official Dialpad API operation `users.update_active_call`.

Endpoint: PATCH /api/v2/users/{id}/activecall.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  182 =>
  [
    'operation' => 'users.update_status',
    'slug' => 'dialpad_users_update_status',
    'class' => 'DialpadUsersUpdateStatus',
    'method' => 'PATCH',
    'path' => '/api/v2/users/{id}/status',
    'name' => 'User Status -- Update',
    'description' => 'Execute official Dialpad API operation `users.update_status`.

Endpoint: PATCH /api/v2/users/{id}/status.',
    'type' => 'write',
    'tag' => 'users',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The user\'s id. (\'me\' can be used if you are using a user level API key]',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  183 =>
  [
    'operation' => 'webhook.update',
    'slug' => 'dialpad_webhook_update',
    'class' => 'DialpadWebhookUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/webhooks/{id}',
    'name' => 'Webhook -- Update',
    'description' => 'Execute official Dialpad API operation `webhook.update`.

Endpoint: PATCH /api/v2/webhooks/{id}.',
    'type' => 'write',
    'tag' => 'webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'string',
        'required' => true,
        'description' => 'The webhook\'s ID, which is generated after creating a webhook successfully.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  184 =>
  [
    'operation' => 'webhooks.create',
    'slug' => 'dialpad_webhooks_create',
    'class' => 'DialpadWebhooksCreate',
    'method' => 'POST',
    'path' => '/api/v2/webhooks',
    'name' => 'Webhook -- Create',
    'description' => 'Execute official Dialpad API operation `webhooks.create`.

Endpoint: POST /api/v2/webhooks.',
    'type' => 'write',
    'tag' => 'webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  185 =>
  [
    'operation' => 'webhooks.delete',
    'slug' => 'dialpad_webhooks_delete',
    'class' => 'DialpadWebhooksDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/webhooks/{id}',
    'name' => 'Webhook -- Delete',
    'description' => 'Execute official Dialpad API operation `webhooks.delete`.

Endpoint: DELETE /api/v2/webhooks/{id}.',
    'type' => 'write',
    'tag' => 'webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The webhook\'s ID, which is generated after creating a webhook successfully.',
      ],
    ],
  ],
  186 =>
  [
    'operation' => 'webhooks.get',
    'slug' => 'dialpad_webhooks_get',
    'class' => 'DialpadWebhooksGet',
    'method' => 'GET',
    'path' => '/api/v2/webhooks/{id}',
    'name' => 'Webhook -- Get',
    'description' => 'Execute official Dialpad API operation `webhooks.get`.

Endpoint: GET /api/v2/webhooks/{id}.',
    'type' => 'read',
    'tag' => 'webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The webhook\'s ID, which is generated after creating a webhook successfully.',
      ],
    ],
  ],
  187 =>
  [
    'operation' => 'webhooks.list',
    'slug' => 'dialpad_webhooks_list',
    'class' => 'DialpadWebhooksList',
    'method' => 'GET',
    'path' => '/api/v2/webhooks',
    'name' => 'Webhook -- List',
    'description' => 'Execute official Dialpad API operation `webhooks.list`.

Endpoint: GET /api/v2/webhooks.',
    'type' => 'read',
    'tag' => 'webhooks',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
    ],
  ],
  188 =>
  [
    'operation' => 'websockets.create',
    'slug' => 'dialpad_websockets_create',
    'class' => 'DialpadWebsocketsCreate',
    'method' => 'POST',
    'path' => '/api/v2/websockets',
    'name' => 'Websocket -- Create',
    'description' => 'Execute official Dialpad API operation `websockets.create`.

Endpoint: POST /api/v2/websockets.',
    'type' => 'write',
    'tag' => 'websockets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
  189 =>
  [
    'operation' => 'websockets.delete',
    'slug' => 'dialpad_websockets_delete',
    'class' => 'DialpadWebsocketsDelete',
    'method' => 'DELETE',
    'path' => '/api/v2/websockets/{id}',
    'name' => 'Websocket -- Delete',
    'description' => 'Execute official Dialpad API operation `websockets.delete`.

Endpoint: DELETE /api/v2/websockets/{id}.',
    'type' => 'write',
    'tag' => 'websockets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The websocket\'s ID, which is generated after creating a websocket successfully.',
      ],
    ],
  ],
  190 =>
  [
    'operation' => 'websockets.get',
    'slug' => 'dialpad_websockets_get',
    'class' => 'DialpadWebsocketsGet',
    'method' => 'GET',
    'path' => '/api/v2/websockets/{id}',
    'name' => 'Websocket -- Get',
    'description' => 'Execute official Dialpad API operation `websockets.get`.

Endpoint: GET /api/v2/websockets/{id}.',
    'type' => 'read',
    'tag' => 'websockets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The websocket\'s ID, which is generated after creating a websocket successfully.',
      ],
    ],
  ],
  191 =>
  [
    'operation' => 'websockets.list',
    'slug' => 'dialpad_websockets_list',
    'class' => 'DialpadWebsocketsList',
    'method' => 'GET',
    'path' => '/api/v2/websockets',
    'name' => 'Websocket -- List',
    'description' => 'Execute official Dialpad API operation `websockets.list`.

Endpoint: GET /api/v2/websockets.',
    'type' => 'read',
    'tag' => 'websockets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'cursor',
        'param' => 'cursor',
        'in' => 'query',
        'type' => 'string',
        'required' => false,
        'description' => 'A token used to return the next page of a previous request. Use the cursor provided in the previous response.',
      ],
    ],
  ],
  192 =>
  [
    'operation' => 'websockets.update',
    'slug' => 'dialpad_websockets_update',
    'class' => 'DialpadWebsocketsUpdate',
    'method' => 'PATCH',
    'path' => '/api/v2/websockets/{id}',
    'name' => 'Websocket -- Update',
    'description' => 'Execute official Dialpad API operation `websockets.update`.

Endpoint: PATCH /api/v2/websockets/{id}.',
    'type' => 'write',
    'tag' => 'websockets',
    'parameters' =>
    [
      0 =>
      [
        'name' => 'id',
        'param' => 'id',
        'in' => 'path',
        'type' => 'integer',
        'required' => true,
        'description' => 'The websocket\'s ID, which is generated after creating a websocket successfully.',
      ],
      1 =>
      [
        'name' => 'body',
        'param' => 'body',
        'in' => 'body',
        'type' => 'object',
        'required' => false,
        'description' => 'JSON request body matching the official Dialpad API schema.',
      ],
    ],
  ],
];
    }
}
