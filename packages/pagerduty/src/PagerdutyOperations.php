<?php

namespace OpenCompany\Integrations\Pagerduty;

/**
 * Official PagerDuty REST OpenAPI operation metadata.
 *
 * Generated from PagerDuty's published OpenAPI schema so tool discovery stays
 * aligned with the upstream API surface.
 */
class PagerdutyOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'pagerduty_associate_service_to_incident_workflow_trigger' =>
  array (
    'slug' => 'pagerduty_associate_service_to_incident_workflow_trigger',
    'class' => 'PagerdutyAssociateServiceToIncidentWorkflowTrigger',
    'method' => 'POST',
    'path' => '/incident_workflows/triggers/{id}/services',
    'operation_id' => 'associateServiceToIncidentWorkflowTrigger',
    'name' => 'Associate a Trigger and Service',
    'description' => 'Associate a Trigger and Service Associate a Service with an existing Incident Workflow Trigger Scoped OAuth requires: `incident_workflows.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_cancel_incident_responder_request' =>
  array (
    'slug' => 'pagerduty_cancel_incident_responder_request',
    'class' => 'PagerdutyCancelIncidentResponderRequest',
    'method' => 'PUT',
    'path' => '/incidents/{id}/responder_requests/cancel',
    'operation_id' => 'cancelIncidentResponderRequest',
    'name' => 'Cancel responder requests for an incident',
    'description' => 'Cancel responder requests for an incident Cancel pending responder requests for the specified incident. This endpoint allows you to cancel responder requests for specified targets that are in a pending state. Only responders who have not yet joined or declined can be cancelled. This endpoint requires the account to have access to the [responder requests](https://support.pagerduty.com/main/docs/add-responders) feature. **Account Ability Requirement**: The account must have the `coordinated_responding` ability. Returns 402 Payment Required if the ability is missing. You can use the [List Abilities API](openapiv3.json/paths/~1abilities/get) to check account abilities. **State Constraints**: Only responders in the `pending` state can be cancelled. Responders who have already `joined` or `declined` are not affected (the result will indicate their current state). **User vs Escalation Policy Behavior**: - **Users**: Direct cancellation, updates state to `user_cancelled`, stops notifications - **Escalation Policies**: Stops the escalation process, updates state of all pending users from that escalation policy to `user_cancelled` and stops notifications **Result Values**: - `cancelled`: Successfully cancelled - `joined`: User already joined (not cancelled) - `declined`: User already declined (not cancelled) - `not_found`: Target not found or not part of any responder request Scoped OAuth requires: `incidents.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_convert_service_event_rules_to_event_orchestration' =>
  array (
    'slug' => 'pagerduty_convert_service_event_rules_to_event_orchestration',
    'class' => 'PagerdutyConvertServiceEventRulesToEventOrchestration',
    'method' => 'POST',
    'path' => '/services/{id}/rules/convert',
    'operation_id' => 'convertServiceEventRulesToEventOrchestration',
    'name' => 'Convert a Service\'s Event Rules into Event Orchestration Rules',
    'description' => 'Convert a Service\'s Event Rules into Event Orchestration Rules Convert this Service\'s Event Rules into functionally equivalent Event Orchestration Rules. Sending a request to this API endpoint has several effects: 1. Automatically creates Event Orchestration Rules for this Service that will behave identically as this Service\'s currently configured Event Rules. 2. Makes all existing Event Rules for this Service read-only. All future updates need to be made via the newly created Event Orchestration rules. Sending a request to this API endpoint will **not** change how future events will be processed. If past events for this Service have been evaluated via Event Rules then new events sent to this Service will also continue to be evaluated via the (now read-only) Event Rules. To change this Service so that new events start being evaluated via the newly created Event Orchestration Rules use the [Update the Service Orchestration active status for a Service API](https://developer.pagerduty.com/api-reference/855659be83d9e-update-the-service-orchestration-active-status-for-a-service). > ### End-of-life > Event Rules will end-of-life soon. We highly recommend that you use this API to [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_create_addon' =>
  array (
    'slug' => 'pagerduty_create_addon',
    'class' => 'PagerdutyCreateAddon',
    'method' => 'POST',
    'path' => '/addons',
    'operation_id' => 'createAddon',
    'name' => 'Install an Add-on',
    'description' => 'Install an Add-on for your account. Addon\'s are pieces of functionality that developers can write to insert new functionality into PagerDuty\'s UI. Given a configuration containing a `src` parameter, that URL will be embedded in an `iframe` on a page that\'s available to users from a drop-down menu. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#add-ons) Scoped OAuth requires: `addons.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The Add-on to be installed.',
    ),
  ),
  'pagerduty_create_automation_action' =>
  array (
    'slug' => 'pagerduty_create_automation_action',
    'class' => 'PagerdutyCreateAutomationAction',
    'method' => 'POST',
    'path' => '/automation_actions/actions',
    'operation_id' => 'createAutomationAction',
    'name' => 'Create an Automation Action',
    'description' => 'Create an Automation Action Create a Script, Process Automation, or Runbook Automation action',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_automation_action_invocation' =>
  array (
    'slug' => 'pagerduty_create_automation_action_invocation',
    'class' => 'PagerdutyCreateAutomationActionInvocation',
    'method' => 'POST',
    'path' => '/automation_actions/actions/{id}/invocations',
    'operation_id' => 'createAutomationActionInvocation',
    'name' => 'Create an Invocation',
    'description' => 'Create an Invocation Invokes an Action',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_automation_action_service_assocation' =>
  array (
    'slug' => 'pagerduty_create_automation_action_service_assocation',
    'class' => 'PagerdutyCreateAutomationActionServiceAssocation',
    'method' => 'POST',
    'path' => '/automation_actions/actions/{id}/services',
    'operation_id' => 'createAutomationActionServiceAssocation',
    'name' => 'Associate an Automation Action with a service',
    'description' => 'Associate an Automation Action with a service',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_automation_action_team_association' =>
  array (
    'slug' => 'pagerduty_create_automation_action_team_association',
    'class' => 'PagerdutyCreateAutomationActionTeamAssociation',
    'method' => 'POST',
    'path' => '/automation_actions/actions/{id}/teams',
    'operation_id' => 'createAutomationActionTeamAssociation',
    'name' => 'Associate an Automation Action with a team',
    'description' => 'Associate an Automation Action with a team',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_automation_actions_runner' =>
  array (
    'slug' => 'pagerduty_create_automation_actions_runner',
    'class' => 'PagerdutyCreateAutomationActionsRunner',
    'method' => 'POST',
    'path' => '/automation_actions/runners',
    'operation_id' => 'createAutomationActionsRunner',
    'name' => 'Create an Automation Action runner.',
    'description' => 'Create an Automation Action runner. Create a Process Automation or a Runbook Automation runner.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_automation_actions_runner_team_association' =>
  array (
    'slug' => 'pagerduty_create_automation_actions_runner_team_association',
    'class' => 'PagerdutyCreateAutomationActionsRunnerTeamAssociation',
    'method' => 'POST',
    'path' => '/automation_actions/runners/{id}/teams',
    'operation_id' => 'createAutomationActionsRunnerTeamAssociation',
    'name' => 'Associate a runner with a team',
    'description' => 'Associate a runner with a team',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_business_service' =>
  array (
    'slug' => 'pagerduty_create_business_service',
    'class' => 'PagerdutyCreateBusinessService',
    'method' => 'POST',
    'path' => '/business_services',
    'operation_id' => 'createBusinessService',
    'name' => 'Create a Business Service',
    'description' => 'Create a Business Service Create a new Business Service. Business services model capabilities that span multiple technical services and that may be owned by several different teams. There is a limit of 5,000 business services per account. If the limit is reached, the API will respond with an error. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#business-services) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_business_service_account_subscription' =>
  array (
    'slug' => 'pagerduty_create_business_service_account_subscription',
    'class' => 'PagerdutyCreateBusinessServiceAccountSubscription',
    'method' => 'POST',
    'path' => '/business_services/{id}/account_subscription',
    'operation_id' => 'createBusinessServiceAccountSubscription',
    'name' => 'Create Business Service Account Subscription',
    'description' => 'Create Business Service Account Subscription Subscribe your Account to a Business Service. Scoped OAuth requires: `subscribers.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_create_business_service_notification_subscribers' =>
  array (
    'slug' => 'pagerduty_create_business_service_notification_subscribers',
    'class' => 'PagerdutyCreateBusinessServiceNotificationSubscribers',
    'method' => 'POST',
    'path' => '/business_services/{id}/subscribers',
    'operation_id' => 'createBusinessServiceNotificationSubscribers',
    'name' => 'Create Business Service Subscribers',
    'description' => 'Create Business Service Subscribers Subscribe the given entities to the given Business Service. Scoped OAuth requires: `subscribers.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The entities to subscribe.',
    ),
  ),
  'pagerduty_create_cache_var_on_global_orch' =>
  array (
    'slug' => 'pagerduty_create_cache_var_on_global_orch',
    'class' => 'PagerdutyCreateCacheVarOnGlobalOrch',
    'method' => 'POST',
    'path' => '/event_orchestrations/{id}/cache_variables',
    'operation_id' => 'createCacheVarOnGlobalOrch',
    'name' => 'Create a Cache Variable for a Global Event Orchestration',
    'description' => 'Create a Cache Variable for a Global Event Orchestration. Cache Variables allow you to store event data on an Event Orchestration, which can then be used in Event Orchestration rules as part of conditions or actions. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'string',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_cache_var_on_service_orch' =>
  array (
    'slug' => 'pagerduty_create_cache_var_on_service_orch',
    'class' => 'PagerdutyCreateCacheVarOnServiceOrch',
    'method' => 'POST',
    'path' => '/event_orchestrations/services/{service_id}/cache_variables',
    'operation_id' => 'createCacheVarOnServiceOrch',
    'name' => 'Create a Cache Variable for a Service Event Orchestration',
    'description' => 'Create a Cache Variable for a Service Event Orchestration. Cache Variables allow you to store event data on an Event Orchestration, which can then be used in Event Orchestration rules as part of conditions or actions. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'string',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_change_event' =>
  array (
    'slug' => 'pagerduty_create_change_event',
    'class' => 'PagerdutyCreateChangeEvent',
    'method' => 'POST',
    'path' => '/change_events',
    'operation_id' => 'createChangeEvent',
    'name' => 'Create a Change Event',
    'description' => 'Create a Change Event Sending Change Events is documented as part of the V2 Events API. See [`Send Change Event`](https://developer.pagerduty.com/api-reference/b3A6Mjc0ODI2Ng-send-change-events-to-the-pager-duty-events-api).',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_create_custom_fields_field' =>
  array (
    'slug' => 'pagerduty_create_custom_fields_field',
    'class' => 'PagerdutyCreateCustomFieldsField',
    'method' => 'POST',
    'path' => '/incidents/custom_fields',
    'operation_id' => 'createCustomFieldsField',
    'name' => 'Create a Field',
    'description' => 'Create a Field <!-- theme: warning --> > ### Deprecated > This endpoint is deprecated and only works for fields on the Base Incident Type. \\ > For more flexibility, we recommend using the Incident Types endpoint: \\ > [/incidents/types/{type_id_or_name}/custom_fields](openapiv3.json/paths/~1incidents~1types~1{type_id_or_name}~1custom_fields/post) Creates a new Custom Field on the Base Incident Type, along with the Field Options if provided. \\ An account may have up to 10 Fields. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_custom_fields_field_option' =>
  array (
    'slug' => 'pagerduty_create_custom_fields_field_option',
    'class' => 'PagerdutyCreateCustomFieldsFieldOption',
    'method' => 'POST',
    'path' => '/incidents/custom_fields/{field_id}/field_options',
    'operation_id' => 'createCustomFieldsFieldOption',
    'name' => 'Create a Field Option',
    'description' => 'Create a Field Option <!-- theme: warning --> > ### Deprecated > This endpoint is deprecated and only works for fields on the Base Incident Type. \\ > For more flexibility, we recommend using the Incident Types endpoint: \\ > [/incidents/types/{type_id_or_name}/custom_fields/{field_id}/field_options](openapiv3.json/paths/~1incidents~1types~1{type_id_or_name}~1custom_fields~1{field_id}~1field_options/post) Create a new Field Option for a Custom Field on the Base Incident Type. Field Options may only be created for Fields that have `field_options`. A Field may have no more than 10 enabled options. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_custom_shifts' =>
  array (
    'slug' => 'pagerduty_create_custom_shifts',
    'class' => 'PagerdutyCreateCustomShifts',
    'method' => 'POST',
    'path' => '/v3/schedules/{id}/custom_shifts',
    'operation_id' => 'createCustomShifts',
    'name' => 'Create custom shifts',
    'description' => 'Create custom shifts <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Create one or more custom shifts for a schedule. Custom shifts are ad-hoc one-off coverage periods that exist outside of rotation events. Each custom shift requires exactly one assignment.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_entity_type_by_id_change_tags' =>
  array (
    'slug' => 'pagerduty_create_entity_type_by_id_change_tags',
    'class' => 'PagerdutyCreateEntityTypeByIdChangeTags',
    'method' => 'POST',
    'path' => '/{entity_type}/{id}/change_tags',
    'operation_id' => 'createEntityTypeByIdChangeTags',
    'name' => 'Assign tags',
    'description' => 'Assign tags Assign existing or new tags. A Tag is applied to Escalation Policies, Teams or Users and can be used to filter them. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#tags) Scoped OAuth requires: `tags.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_escalation_policy' =>
  array (
    'slug' => 'pagerduty_create_escalation_policy',
    'class' => 'PagerdutyCreateEscalationPolicy',
    'method' => 'POST',
    'path' => '/escalation_policies',
    'operation_id' => 'createEscalationPolicy',
    'name' => 'Create an escalation policy',
    'description' => 'Create an escalation policy Creates a new escalation policy. At least one escalation rule must be provided. Escalation policies define which user should be alerted at which time. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#escalation-policies) Scoped OAuth requires: `escalation_policies.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The escalation policy to be created.',
    ),
  ),
  'pagerduty_create_event' =>
  array (
    'slug' => 'pagerduty_create_event',
    'class' => 'PagerdutyCreateEvent',
    'method' => 'POST',
    'path' => '/v3/schedules/{id}/rotations/{rotation_id}/events',
    'operation_id' => 'createEvent',
    'name' => 'Create an event',
    'description' => 'Create an event <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Create a new event that defines when and how users are on-call within a rotation. **Constraints:** - Maximum 5 events per rotation - Events within a rotation cannot overlap - `effective_since` must be in the future (past values are clamped to now) - All users referenced in `assignment_strategy.members` must exist and belong to the account',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_extension' =>
  array (
    'slug' => 'pagerduty_create_extension',
    'class' => 'PagerdutyCreateExtension',
    'method' => 'POST',
    'path' => '/extensions',
    'operation_id' => 'createExtension',
    'name' => 'Create an extension',
    'description' => 'Create an extension Create a new Extension. Extensions are representations of Extension Schema objects that are attached to Services. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#extensions) Scoped OAuth requires: `extensions.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The extension to be created',
    ),
  ),
  'pagerduty_create_incident' =>
  array (
    'slug' => 'pagerduty_create_incident',
    'class' => 'PagerdutyCreateIncident',
    'method' => 'POST',
    'path' => '/incidents',
    'operation_id' => 'createIncident',
    'name' => 'Create an Incident',
    'description' => 'Create an Incident Create an incident synchronously without a corresponding event from a monitoring service. An incident represents a problem or an issue that needs to be addressed and resolved. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.write` This API operation has operation specific rate limits. See the [Rate Limits](https://developer.pagerduty.com/docs/72d3b724589e3-rest-api-rate-limits) page for more information.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_incident_note' =>
  array (
    'slug' => 'pagerduty_create_incident_note',
    'class' => 'PagerdutyCreateIncidentNote',
    'method' => 'POST',
    'path' => '/incidents/{id}/notes',
    'operation_id' => 'createIncidentNote',
    'name' => 'Create a note on an incident',
    'description' => 'Create a note on an incident Create a new note for the specified incident. An incident represents a problem or an issue that needs to be addressed and resolved. A maximum of 2000 notes can be added to an incident. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_incident_notification_subscribers' =>
  array (
    'slug' => 'pagerduty_create_incident_notification_subscribers',
    'class' => 'PagerdutyCreateIncidentNotificationSubscribers',
    'method' => 'POST',
    'path' => '/incidents/{id}/status_updates/subscribers',
    'operation_id' => 'createIncidentNotificationSubscribers',
    'name' => 'Add Notification Subscribers',
    'description' => 'Add Notification Subscribers Subscribe the given entities to Incident Status Update Notifications. Scoped OAuth requires: `subscribers.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The entities to subscribe.',
    ),
  ),
  'pagerduty_create_incident_responder_request' =>
  array (
    'slug' => 'pagerduty_create_incident_responder_request',
    'class' => 'PagerdutyCreateIncidentResponderRequest',
    'method' => 'POST',
    'path' => '/incidents/{id}/responder_requests',
    'operation_id' => 'createIncidentResponderRequest',
    'name' => 'Create a responder request for an incident',
    'description' => 'Create a responder request for an incident Send a new responder request for the specified incident. This endpoint requires the account to have access to the [responder requests](https://support.pagerduty.com/main/docs/add-responders) feature. **Account Ability Requirement**: The account must have the `coordinated_responding` ability. Returns 402 Payment Required if the ability is missing. You can use the [List Abilities API](openapiv3.json/paths/~1abilities/get) to check account abilities. A user or an escalation policy can be requested. The responder targets will be notified via their high urgency notification rules, until the target user has either accepted or declined the request. Previous responder requests for a given target can be cancelled (preventing them from further notifying or escalating), with the [Cancel Responder Requests](openapiv3.json/paths/~1incidents~1{id}~1responder_requests~1cancel/put) endpoint. Scoped OAuth requires: `incidents.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_incident_snooze' =>
  array (
    'slug' => 'pagerduty_create_incident_snooze',
    'class' => 'PagerdutyCreateIncidentSnooze',
    'method' => 'POST',
    'path' => '/incidents/{id}/snooze',
    'operation_id' => 'createIncidentSnooze',
    'name' => 'Snooze an incident',
    'description' => 'Snooze an incident. An incident represents a problem or an issue that needs to be addressed and resolved. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_incident_status_update' =>
  array (
    'slug' => 'pagerduty_create_incident_status_update',
    'class' => 'PagerdutyCreateIncidentStatusUpdate',
    'method' => 'POST',
    'path' => '/incidents/{id}/status_updates',
    'operation_id' => 'createIncidentStatusUpdate',
    'name' => 'Create a status update on an incident',
    'description' => 'Create a status update on an incident Create a new status update for the specified incident. Optionally pass `subject` and `html_message` properties in the request body to override the email notification that gets sent. An incident represents a problem or an issue that needs to be addressed and resolved. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_incident_type' =>
  array (
    'slug' => 'pagerduty_create_incident_type',
    'class' => 'PagerdutyCreateIncidentType',
    'method' => 'POST',
    'path' => '/incidents/types',
    'operation_id' => 'createIncidentType',
    'name' => 'Create an Incident Type',
    'description' => 'Create an Incident Type Create a new incident type. Incident Types are a feature which will allow customers to categorize incidents, such as a security incident, a major incident, or a fraud incident. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidentType) Scoped OAuth requires: `incident_types.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_incident_type_custom_field' =>
  array (
    'slug' => 'pagerduty_create_incident_type_custom_field',
    'class' => 'PagerdutyCreateIncidentTypeCustomField',
    'method' => 'POST',
    'path' => '/incidents/types/{type_id_or_name}/custom_fields',
    'operation_id' => 'createIncidentTypeCustomField',
    'name' => 'Create a Custom Field for an Incident Type',
    'description' => 'Create a Custom Field for an Incident Type Custom Fields (CF) are a feature which will allow customers to extend Incidents with their own custom data, to provide additional context and support features such as customized filtering, search and analytics. Custom Fields can be applied to different incident types. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_incident_type_custom_field_field_options' =>
  array (
    'slug' => 'pagerduty_create_incident_type_custom_field_field_options',
    'class' => 'PagerdutyCreateIncidentTypeCustomFieldFieldOptions',
    'method' => 'POST',
    'path' => '/incidents/types/{type_id_or_name}/custom_fields/{field_id}/field_options',
    'operation_id' => 'createIncidentTypeCustomFieldFieldOptions',
    'name' => 'Create a Field Option for a Custom Field',
    'description' => 'Create a Field Option for a Custom Field Create a field option for a custom field. Custom Fields (CF) are a feature which will allow customers to extend Incidents with their own custom data, to provide additional context and support features such as customized filtering, search and analytics. Custom Fields can be applied to different incident types. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_incident_workflow_instance' =>
  array (
    'slug' => 'pagerduty_create_incident_workflow_instance',
    'class' => 'PagerdutyCreateIncidentWorkflowInstance',
    'method' => 'POST',
    'path' => '/incident_workflows/{id}/instances',
    'operation_id' => 'createIncidentWorkflowInstance',
    'name' => 'Start an Incident Workflow Instance',
    'description' => 'Start an Incident Workflow Instance Start an Instance of an Incident Workflow. Sometimes referred to as "triggering a workflow on an incident." An Incident Workflow is a sequence of configurable Steps and associated Triggers that can execute automated Actions for a given Incident. Scoped OAuth requires: `incident_workflows:instances.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_incident_workflow_trigger' =>
  array (
    'slug' => 'pagerduty_create_incident_workflow_trigger',
    'class' => 'PagerdutyCreateIncidentWorkflowTrigger',
    'method' => 'POST',
    'path' => '/incident_workflows/triggers',
    'operation_id' => 'createIncidentWorkflowTrigger',
    'name' => 'Create a Trigger',
    'description' => 'Create a Trigger Create new Incident Workflow Trigger Scoped OAuth requires: `incident_workflows.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_maintenance_window' =>
  array (
    'slug' => 'pagerduty_create_maintenance_window',
    'class' => 'PagerdutyCreateMaintenanceWindow',
    'method' => 'POST',
    'path' => '/maintenance_windows',
    'operation_id' => 'createMaintenanceWindow',
    'name' => 'Create a maintenance window',
    'description' => 'Create a maintenance window Create a new maintenance window for the specified services. No new incidents will be created for a service that is in maintenance. A Maintenance Window is used to temporarily disable one or more Services for a set period of time. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#maintenance-windows) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The maintenance window object.',
    ),
  ),
  'pagerduty_create_oauth_client' =>
  array (
    'slug' => 'pagerduty_create_oauth_client',
    'class' => 'PagerdutyCreateOauthClient',
    'method' => 'POST',
    'path' => '/webhook_subscriptions/oauth_clients',
    'operation_id' => 'createOauthClient',
    'name' => 'Create an OAuth client',
    'description' => 'Create an OAuth client Create a new OAuth client for webhook subscriptions. The client credentials will be validated by attempting to obtain an access token before creation. Requires admin or owner role permissions. Maximum of 10 OAuth clients per account.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_or_update_status_page_postmortem' =>
  array (
    'slug' => 'pagerduty_create_or_update_status_page_postmortem',
    'class' => 'PagerdutyCreateOrUpdateStatusPagePostmortem',
    'method' => 'PUT',
    'path' => '/status_pages/{id}/posts/{post_id}/postmortem',
    'operation_id' => 'createOrUpdateStatusPagePostmortem',
    'name' => 'Create or Update a Post Postmortem',
    'description' => 'Create or Update a Post Postmortem Create or Update a Postmortem for a Post by Post ID. Scoped OAuth requires: `status_pages.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_overrides' =>
  array (
    'slug' => 'pagerduty_create_overrides',
    'class' => 'PagerdutyCreateOverrides',
    'method' => 'POST',
    'path' => '/v3/schedules/{id}/overrides',
    'operation_id' => 'createOverrides',
    'name' => 'Create overrides',
    'description' => 'Create overrides <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Create one or more overrides for a schedule. An override temporarily replaces a scheduled on-call member with a different member for a specific time period. Each override must reference either a `rotation_id` or a `custom_shift_id` (not both). The overriding member must belong to the account. **Note:** The create response wraps the result in an `overrides` array. Single-resource endpoints (get, update) wrap in `override` (singular).',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_rotation' =>
  array (
    'slug' => 'pagerduty_create_rotation',
    'class' => 'PagerdutyCreateRotation',
    'method' => 'POST',
    'path' => '/v3/schedules/{id}/rotations',
    'operation_id' => 'createRotation',
    'name' => 'Create a rotation',
    'description' => 'Create a rotation <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Create a new empty rotation for a schedule. After creating a rotation, add events to define the on-call pattern. **Note:** Rotations have no configuration of their own - all scheduling logic (recurrence, assignment strategy, members) is specified on events. The request body must be empty or `{}`.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_ruleset' =>
  array (
    'slug' => 'pagerduty_create_ruleset',
    'class' => 'PagerdutyCreateRuleset',
    'method' => 'POST',
    'path' => '/rulesets',
    'operation_id' => 'createRuleset',
    'name' => 'Create a Ruleset',
    'description' => 'Create a Ruleset Create a new Ruleset. <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Rulesets allow you to route events to an endpoint and create collections of Event Rules, which define sets of actions to take based on event content. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#rulesets) Scoped OAuth requires: `event_rules.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_ruleset_event_rule' =>
  array (
    'slug' => 'pagerduty_create_ruleset_event_rule',
    'class' => 'PagerdutyCreateRulesetEventRule',
    'method' => 'POST',
    'path' => '/rulesets/{id}/rules',
    'operation_id' => 'createRulesetEventRule',
    'name' => 'Create an Event Rule',
    'description' => 'Create an Event Rule Create a new Event Rule. <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Rulesets allow you to route events to an endpoint and create collections of Event Rules, which define sets of actions to take based on event content. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#rulesets) Note: Create and Update on rules will accept \'description\' or \'summary\' interchangeably as an extraction action target. Get and List on rules will always return \'summary\' as the target. If you are expecting \'description\' please change your automation code to expect \'summary\' instead. Scoped OAuth requires: `event_rules.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_schedule' =>
  array (
    'slug' => 'pagerduty_create_schedule',
    'class' => 'PagerdutyCreateSchedule',
    'method' => 'POST',
    'path' => '/schedules',
    'operation_id' => 'createSchedule',
    'name' => 'Create a schedule',
    'description' => 'Create a schedule Create a new on-call schedule. A Schedule determines the time periods that users are On-Call. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#schedules) Scoped OAuth requires: `schedules.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The schedule to be created.',
    ),
  ),
  'pagerduty_create_schedule_override' =>
  array (
    'slug' => 'pagerduty_create_schedule_override',
    'class' => 'PagerdutyCreateScheduleOverride',
    'method' => 'POST',
    'path' => '/schedules/{id}/overrides',
    'operation_id' => 'createScheduleOverride',
    'name' => 'Create one or more overrides',
    'description' => 'Create one or more overrides, each for a specific user covering a specified time range. If you create an override on top of an existing override, the last created override will have priority. A Schedule determines the time periods that users are On-Call. Note: An older implementation of this endpoint only supported creating a single ocverride per request. That functionality is still supported, but deprecated and may be removed in the future. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#schedules) Scoped OAuth requires: `schedules.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'The overrides to be created',
    ),
  ),
  'pagerduty_create_schedule_preview' =>
  array (
    'slug' => 'pagerduty_create_schedule_preview',
    'class' => 'PagerdutyCreateSchedulePreview',
    'method' => 'POST',
    'path' => '/schedules/preview',
    'operation_id' => 'createSchedulePreview',
    'name' => 'Preview a schedule',
    'description' => 'Preview a schedule Preview what an on-call schedule would look like without saving it. A Schedule determines the time periods that users are On-Call. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#schedules) Scoped OAuth requires: `schedules.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The schedule to be previewed.',
    ),
  ),
  'pagerduty_create_schedule_v3' =>
  array (
    'slug' => 'pagerduty_create_schedule_v3',
    'class' => 'PagerdutyCreateScheduleV3',
    'method' => 'POST',
    'path' => '/v3/schedules',
    'operation_id' => 'createScheduleV3',
    'name' => 'Create a schedule',
    'description' => 'Create a schedule <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Create a new on-call schedule with basic metadata. Rotations and events must be added via separate API calls after creation. **Rejected fields:** `rotations` and `escalation_policies` are not accepted in the request body and will result in a 400 error.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_service' =>
  array (
    'slug' => 'pagerduty_create_service',
    'class' => 'PagerdutyCreateService',
    'method' => 'POST',
    'path' => '/services',
    'operation_id' => 'createService',
    'name' => 'Create a service',
    'description' => 'Create a service Create a new service. If `status` is included in the request, it must have a value of `active` when creating a new service. If a different status is required, make a second request to update the service. A service may represent an application, component, or team you wish to open incidents against. There is a limit of 25,000 services per account. If the limit is reached, the API will respond with an error. There is also a limit of 100,000 open Incidents per Service. If the limit is reached and `auto_resolve_timeout` is disabled (set to 0 or null), the `auto_resolve_timeout` property will automatically be set to 84600 (1 day). For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#services) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The service to be created',
    ),
  ),
  'pagerduty_create_service_custom_field' =>
  array (
    'slug' => 'pagerduty_create_service_custom_field',
    'class' => 'PagerdutyCreateServiceCustomField',
    'method' => 'POST',
    'path' => '/services/custom_fields',
    'operation_id' => 'createServiceCustomField',
    'name' => 'Create a Field',
    'description' => 'Create a Field Creates a new Custom Field for Services, along with the Field Options if provided. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_service_custom_field_option' =>
  array (
    'slug' => 'pagerduty_create_service_custom_field_option',
    'class' => 'PagerdutyCreateServiceCustomFieldOption',
    'method' => 'POST',
    'path' => '/services/custom_fields/{field_id}/field_options',
    'operation_id' => 'createServiceCustomFieldOption',
    'name' => 'Create a Field Option',
    'description' => 'Create a Field Option Create a new option for the given field. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_service_dependency' =>
  array (
    'slug' => 'pagerduty_create_service_dependency',
    'class' => 'PagerdutyCreateServiceDependency',
    'method' => 'POST',
    'path' => '/service_dependencies/associate',
    'operation_id' => 'createServiceDependency',
    'name' => 'Associate service dependencies',
    'description' => 'Associate service dependencies Create new dependencies between two services. Business services model capabilities that span multiple technical services and that may be owned by several different teams. A service can have a maximum of 2,000 dependencies with a depth limit of 100. If the limit is reached, the API will respond with an error. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#business-services) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_service_event_rule' =>
  array (
    'slug' => 'pagerduty_create_service_event_rule',
    'class' => 'PagerdutyCreateServiceEventRule',
    'method' => 'POST',
    'path' => '/services/{id}/rules',
    'operation_id' => 'createServiceEventRule',
    'name' => 'Create an Event Rule on a Service',
    'description' => 'Create an Event Rule on a Service Create a new Event Rule on a Service. <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_service_integration' =>
  array (
    'slug' => 'pagerduty_create_service_integration',
    'class' => 'PagerdutyCreateServiceIntegration',
    'method' => 'POST',
    'path' => '/services/{id}/integrations',
    'operation_id' => 'createServiceIntegration',
    'name' => 'Create a new integration',
    'description' => 'Create a new integration belonging to a Service. A service may represent an application, component, or team you wish to open incidents against. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#services) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The integration to be created',
    ),
  ),
  'pagerduty_create_status_page_post' =>
  array (
    'slug' => 'pagerduty_create_status_page_post',
    'class' => 'PagerdutyCreateStatusPagePost',
    'method' => 'POST',
    'path' => '/status_pages/{id}/posts',
    'operation_id' => 'createStatusPagePost',
    'name' => 'Create a Status Page Post',
    'description' => 'Create a Status Page Post Create a Post for a Status Page by Status Page ID. Scoped OAuth requires: `status_pages.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_status_page_post_update' =>
  array (
    'slug' => 'pagerduty_create_status_page_post_update',
    'class' => 'PagerdutyCreateStatusPagePostUpdate',
    'method' => 'POST',
    'path' => '/status_pages/{id}/posts/{post_id}/post_updates',
    'operation_id' => 'createStatusPagePostUpdate',
    'name' => 'Create a Status Page Post Update',
    'description' => 'Create a Status Page Post Update Create a Post Update for a Post by Post ID. Scoped OAuth requires: `status_pages.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_status_page_subscription' =>
  array (
    'slug' => 'pagerduty_create_status_page_subscription',
    'class' => 'PagerdutyCreateStatusPageSubscription',
    'method' => 'POST',
    'path' => '/status_pages/{id}/subscriptions',
    'operation_id' => 'createStatusPageSubscription',
    'name' => 'Create a Status Page Subscription',
    'description' => 'Create a Status Page Subscription Create a Subscription for a Status Page by Status Page ID. Scoped OAuth requires: `status_pages.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_tags' =>
  array (
    'slug' => 'pagerduty_create_tags',
    'class' => 'PagerdutyCreateTags',
    'method' => 'POST',
    'path' => '/tags',
    'operation_id' => 'createTags',
    'name' => 'Create a tag',
    'description' => 'Create a tag Create a Tag. A Tag is applied to Escalation Policies, Teams or Users and can be used to filter them. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#tags) Scoped OAuth requires: `tags.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_team' =>
  array (
    'slug' => 'pagerduty_create_team',
    'class' => 'PagerdutyCreateTeam',
    'method' => 'POST',
    'path' => '/teams',
    'operation_id' => 'createTeam',
    'name' => 'Create a team',
    'description' => 'Create a team Create a new Team. A team is a collection of Users and Escalation Policies that represent a group of people within an organization. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#teams) Scoped OAuth requires: `teams.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The team to be created.',
    ),
  ),
  'pagerduty_create_team_notification_subscriptions' =>
  array (
    'slug' => 'pagerduty_create_team_notification_subscriptions',
    'class' => 'PagerdutyCreateTeamNotificationSubscriptions',
    'method' => 'POST',
    'path' => '/teams/{id}/notification_subscriptions',
    'operation_id' => 'createTeamNotificationSubscriptions',
    'name' => 'Create Team Notification Subscriptions',
    'description' => 'Create Team Notification Subscriptions Create new Notification Subscriptions for the given Team. Scoped OAuth requires: `subscribers.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The entities to subscribe to.',
    ),
  ),
  'pagerduty_create_template' =>
  array (
    'slug' => 'pagerduty_create_template',
    'class' => 'PagerdutyCreateTemplate',
    'method' => 'POST',
    'path' => '/templates',
    'operation_id' => 'createTemplate',
    'name' => 'Create a template',
    'description' => 'Create a template Create a new template Scoped OAuth requires: `templates.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_user' =>
  array (
    'slug' => 'pagerduty_create_user',
    'class' => 'PagerdutyCreateUser',
    'method' => 'POST',
    'path' => '/users',
    'operation_id' => 'createUser',
    'name' => 'Create a user',
    'description' => 'Create a user Create a new user. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The user to be created.',
    ),
  ),
  'pagerduty_create_user_contact_method' =>
  array (
    'slug' => 'pagerduty_create_user_contact_method',
    'class' => 'PagerdutyCreateUserContactMethod',
    'method' => 'POST',
    'path' => '/users/{id}/contact_methods',
    'operation_id' => 'createUserContactMethod',
    'name' => 'Create a user contact method',
    'description' => 'Create a user contact method Create a new contact method for the User. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users:contact_methods.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The contact method to be created.',
    ),
  ),
  'pagerduty_create_user_handoff_notification_rule' =>
  array (
    'slug' => 'pagerduty_create_user_handoff_notification_rule',
    'class' => 'PagerdutyCreateUserHandoffNotificationRule',
    'method' => 'POST',
    'path' => '/users/{id}/oncall_handoff_notification_rules',
    'operation_id' => 'createUserHandoffNotificationRule',
    'name' => 'Create a User Handoff Notification Rule',
    'description' => 'Create a User Handoff Notification Rule Create a new Handoff Notification Rule. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The Handoff Notification Rule to be created.',
    ),
  ),
  'pagerduty_create_user_notification_rule' =>
  array (
    'slug' => 'pagerduty_create_user_notification_rule',
    'class' => 'PagerdutyCreateUserNotificationRule',
    'method' => 'POST',
    'path' => '/users/{id}/notification_rules',
    'operation_id' => 'createUserNotificationRule',
    'name' => 'Create a user notification rule',
    'description' => 'Create a user notification rule Create a new notification rule. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users:contact_methods.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The notification rule to be created.',
    ),
  ),
  'pagerduty_create_user_notification_subscriptions' =>
  array (
    'slug' => 'pagerduty_create_user_notification_subscriptions',
    'class' => 'PagerdutyCreateUserNotificationSubscriptions',
    'method' => 'POST',
    'path' => '/users/{id}/notification_subscriptions',
    'operation_id' => 'createUserNotificationSubscriptions',
    'name' => 'Create Notification Subcriptions',
    'description' => 'Create Notification Subcriptions Create new Notification Subscriptions for the given User. Scoped OAuth requires: `subscribers.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The entities to subscribe to.',
    ),
  ),
  'pagerduty_create_user_status_update_notification_rule' =>
  array (
    'slug' => 'pagerduty_create_user_status_update_notification_rule',
    'class' => 'PagerdutyCreateUserStatusUpdateNotificationRule',
    'method' => 'POST',
    'path' => '/users/{id}/status_update_notification_rules',
    'operation_id' => 'createUserStatusUpdateNotificationRule',
    'name' => 'Create a user status update notification rule',
    'description' => 'Create a user status update notification rule Create a new status update notification rule. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The status update notification rule to be created.',
    ),
  ),
  'pagerduty_create_webhook_subscription' =>
  array (
    'slug' => 'pagerduty_create_webhook_subscription',
    'class' => 'PagerdutyCreateWebhookSubscription',
    'method' => 'POST',
    'path' => '/webhook_subscriptions',
    'operation_id' => 'createWebhookSubscription',
    'name' => 'Create a webhook subscription',
    'description' => 'Create a webhook subscription Creates a new webhook subscription. For more information on webhook subscriptions and how they are used to configure v3 webhooks see the [Webhooks v3 Developer Documentation](https://developer.pagerduty.com/docs/webhooks/v3-overview/). Scoped OAuth requires: `webhook_subscriptions.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_create_workflow_integration_connection' =>
  array (
    'slug' => 'pagerduty_create_workflow_integration_connection',
    'class' => 'PagerdutyCreateWorkflowIntegrationConnection',
    'method' => 'POST',
    'path' => '/workflows/integrations/{integration_id}/connections',
    'operation_id' => 'createWorkflowIntegrationConnection',
    'name' => 'Create Workflow Integration Connection',
    'description' => 'Create Workflow Integration Connection Create a new Workflow Integration Connection. Scoped OAuth requires: `workflow_integrations:connections.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'string',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_delete_addon' =>
  array (
    'slug' => 'pagerduty_delete_addon',
    'class' => 'PagerdutyDeleteAddon',
    'method' => 'DELETE',
    'path' => '/addons/{id}',
    'operation_id' => 'deleteAddon',
    'name' => 'Delete an Add-on',
    'description' => 'Delete an Add-on Remove an existing Add-on. Addon\'s are pieces of functionality that developers can write to insert new functionality into PagerDuty\'s UI. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#add-ons) Scoped OAuth requires: `addons.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_alert_grouping_setting' =>
  array (
    'slug' => 'pagerduty_delete_alert_grouping_setting',
    'class' => 'PagerdutyDeleteAlertGroupingSetting',
    'method' => 'DELETE',
    'path' => '/alert_grouping_settings/{id}',
    'operation_id' => 'deleteAlertGroupingSetting',
    'name' => 'Delete an Alert Grouping Setting',
    'description' => 'Delete an Alert Grouping Setting Delete an existing Alert Grouping Setting. The settings part of Alert Grouper service allows us to create Alert Grouping Settings and configs that are required to be used during grouping of the alerts. Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_automation_action' =>
  array (
    'slug' => 'pagerduty_delete_automation_action',
    'class' => 'PagerdutyDeleteAutomationAction',
    'method' => 'DELETE',
    'path' => '/automation_actions/actions/{id}',
    'operation_id' => 'deleteAutomationAction',
    'name' => 'Delete an Automation Action',
    'description' => 'Delete an Automation Action',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_automation_action_service_association' =>
  array (
    'slug' => 'pagerduty_delete_automation_action_service_association',
    'class' => 'PagerdutyDeleteAutomationActionServiceAssociation',
    'method' => 'DELETE',
    'path' => '/automation_actions/actions/{id}/services/{service_id}',
    'operation_id' => 'deleteAutomationActionServiceAssociation',
    'name' => 'Disassociate an Automation Action from a service',
    'description' => 'Disassociate an Automation Action from a service',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_automation_action_team_association' =>
  array (
    'slug' => 'pagerduty_delete_automation_action_team_association',
    'class' => 'PagerdutyDeleteAutomationActionTeamAssociation',
    'method' => 'DELETE',
    'path' => '/automation_actions/actions/{id}/teams/{team_id}',
    'operation_id' => 'deleteAutomationActionTeamAssociation',
    'name' => 'Disassociate an Automation Action from a team',
    'description' => 'Disassociate an Automation Action from a team',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_automation_actions_runner' =>
  array (
    'slug' => 'pagerduty_delete_automation_actions_runner',
    'class' => 'PagerdutyDeleteAutomationActionsRunner',
    'method' => 'DELETE',
    'path' => '/automation_actions/runners/{id}',
    'operation_id' => 'deleteAutomationActionsRunner',
    'name' => 'Delete an Automation Action runner',
    'description' => 'Delete an Automation Action runner',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_automation_actions_runner_team_association' =>
  array (
    'slug' => 'pagerduty_delete_automation_actions_runner_team_association',
    'class' => 'PagerdutyDeleteAutomationActionsRunnerTeamAssociation',
    'method' => 'DELETE',
    'path' => '/automation_actions/runners/{id}/teams/{team_id}',
    'operation_id' => 'deleteAutomationActionsRunnerTeamAssociation',
    'name' => 'Disassociate a runner from a team',
    'description' => 'Disassociate a runner from a team Disassociates a runner from a team',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_business_service' =>
  array (
    'slug' => 'pagerduty_delete_business_service',
    'class' => 'PagerdutyDeleteBusinessService',
    'method' => 'DELETE',
    'path' => '/business_services/{id}',
    'operation_id' => 'deleteBusinessService',
    'name' => 'Delete a Business Service',
    'description' => 'Delete a Business Service Delete an existing Business Service. Once the service is deleted, it will not be accessible from the web UI and new incidents won\'t be able to be created for this service. Business services model capabilities that span multiple technical services and that may be owned by several different teams. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#business-services) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_business_service_priority_thresholds' =>
  array (
    'slug' => 'pagerduty_delete_business_service_priority_thresholds',
    'class' => 'PagerdutyDeleteBusinessServicePriorityThresholds',
    'method' => 'DELETE',
    'path' => '/business_services/priority_thresholds',
    'operation_id' => 'deleteBusinessServicePriorityThresholds',
    'name' => 'Deletes the account-level priority threshold for Business Service impact',
    'description' => 'Deletes the account-level priority threshold for Business Service impact Clears the Priority Threshold for the account. If the priority threshold is cleared, any Incident with a Priority set will be able to impact Business Services. Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_cache_var_on_global_orch' =>
  array (
    'slug' => 'pagerduty_delete_cache_var_on_global_orch',
    'class' => 'PagerdutyDeleteCacheVarOnGlobalOrch',
    'method' => 'DELETE',
    'path' => '/event_orchestrations/{id}/cache_variables/{cache_variable_id}',
    'operation_id' => 'deleteCacheVarOnGlobalOrch',
    'name' => 'Delete a Cache Variable for a Global Event Orchestration',
    'description' => 'Delete a Cache Variable for a Global Event Orchestration. Cache Variables allow you to store event data on an Event Orchestration, which can then be used in Event Orchestration rules as part of conditions or actions. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_cache_var_on_service_orch' =>
  array (
    'slug' => 'pagerduty_delete_cache_var_on_service_orch',
    'class' => 'PagerdutyDeleteCacheVarOnServiceOrch',
    'method' => 'DELETE',
    'path' => '/event_orchestrations/services/{service_id}/cache_variables/{cache_variable_id}',
    'operation_id' => 'deleteCacheVarOnServiceOrch',
    'name' => 'Delete a Cache Variable for a Service Event Orchestration',
    'description' => 'Delete a Cache Variable for a Service Event Orchestration. Cache Variables allow you to store event data on an Event Orchestration, which can then be used in Event Orchestration rules as part of conditions or actions. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_custom_fields_field' =>
  array (
    'slug' => 'pagerduty_delete_custom_fields_field',
    'class' => 'PagerdutyDeleteCustomFieldsField',
    'method' => 'DELETE',
    'path' => '/incidents/custom_fields/{field_id}',
    'operation_id' => 'deleteCustomFieldsField',
    'name' => 'Delete a Field',
    'description' => 'Delete a Field <!-- theme: warning --> > ### Deprecated > This endpoint is deprecated and only works for fields on the Base Incident Type. \\ > For more flexibility, we recommend using the Incident Types endpoint: \\ > [/incidents/types/{type_id_or_name}/custom_fields/{field_id}](openapiv3.json/paths/~1incidents~1types~1{type_id_or_name}~1custom_fields~1{field_id}/delete) Delete a Custom Field from the Base Incident Type. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_custom_fields_field_option' =>
  array (
    'slug' => 'pagerduty_delete_custom_fields_field_option',
    'class' => 'PagerdutyDeleteCustomFieldsFieldOption',
    'method' => 'DELETE',
    'path' => '/incidents/custom_fields/{field_id}/field_options/{field_option_id}',
    'operation_id' => 'deleteCustomFieldsFieldOption',
    'name' => 'Delete a Field Option',
    'description' => 'Delete a Field Option <!-- theme: warning --> > ### Deprecated > This endpoint is deprecated and only works for fields on the Base Incident Type. \\ > For more flexibility, we recommend using the Incident Types endpoint: \\ > [/incidents/types/{type_id_or_name}/custom_fields/{field_id}/field_options/{field_option_id}](openapiv3.json/paths/~1incidents~1types~1{type_id_or_name}~1custom_fields~1{field_id}~1field_options~1{field_option_id}/delete) Delete a Field Option for a Custom Field on the Base Incident Type. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_custom_shift' =>
  array (
    'slug' => 'pagerduty_delete_custom_shift',
    'class' => 'PagerdutyDeleteCustomShift',
    'method' => 'DELETE',
    'path' => '/v3/schedules/{id}/custom_shifts/{custom_shift_id}',
    'operation_id' => 'deleteCustomShift',
    'name' => 'Delete a custom shift',
    'description' => 'Delete a custom shift <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Delete a custom shift by ID. When the shift is not started, it deletes the shift entirely. If the shift is already started, it sets the end_time to now. It returns Bad Request when shift is already ended.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_escalation_policy' =>
  array (
    'slug' => 'pagerduty_delete_escalation_policy',
    'class' => 'PagerdutyDeleteEscalationPolicy',
    'method' => 'DELETE',
    'path' => '/escalation_policies/{id}',
    'operation_id' => 'deleteEscalationPolicy',
    'name' => 'Delete an escalation policy',
    'description' => 'Delete an escalation policy Deletes an existing escalation policy and rules. The escalation policy must not be in use by any services. Escalation policies define which user should be alerted at which time. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#escalation-policies) Scoped OAuth requires: `escalation_policies.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_event' =>
  array (
    'slug' => 'pagerduty_delete_event',
    'class' => 'PagerdutyDeleteEvent',
    'method' => 'DELETE',
    'path' => '/v3/schedules/{id}/rotations/{rotation_id}/events/{event_id}',
    'operation_id' => 'deleteEvent',
    'name' => 'Delete an event',
    'description' => 'Delete an event <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Delete an event from a rotation.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_extension' =>
  array (
    'slug' => 'pagerduty_delete_extension',
    'class' => 'PagerdutyDeleteExtension',
    'method' => 'DELETE',
    'path' => '/extensions/{id}',
    'operation_id' => 'deleteExtension',
    'name' => 'Delete an extension',
    'description' => 'Delete an extension Delete an existing extension. Once the extension is deleted, it will not be accessible from the web UI and new incidents won\'t be able to be created for this extension. Extensions are representations of Extension Schema objects that are attached to Services. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#extensions) Scoped OAuth requires: `extensions.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_external_data_cache_var_data_on_global_orch' =>
  array (
    'slug' => 'pagerduty_delete_external_data_cache_var_data_on_global_orch',
    'class' => 'PagerdutyDeleteExternalDataCacheVarDataOnGlobalOrch',
    'method' => 'DELETE',
    'path' => '/event_orchestrations/{id}/cache_variables/{cache_variable_id}/data',
    'operation_id' => 'deleteExternalDataCacheVarDataOnGlobalOrch',
    'name' => 'Delete Data for an External Data Cache Variable on a Global Event Orchestration',
    'description' => 'Delete Data for an External Data Cache Variable on a Global Event Orchestration Delete data for an `external_data` type Cache Variable on a Global Event Orchestration Use External Data type Cache Variables to store string, number, or boolean values via a dedicated API endpoint. These stored values can then be used in conditions or actions in Event Orchestration rules. For more information see the [Knowledge Base](https://support.pagerduty.com/main/docs/event-orchestration-cache-variables) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_external_data_cache_var_data_on_service_orch' =>
  array (
    'slug' => 'pagerduty_delete_external_data_cache_var_data_on_service_orch',
    'class' => 'PagerdutyDeleteExternalDataCacheVarDataOnServiceOrch',
    'method' => 'DELETE',
    'path' => '/event_orchestrations/services/{service_id}/cache_variables/{cache_variable_id}/data',
    'operation_id' => 'deleteExternalDataCacheVarDataOnServiceOrch',
    'name' => 'Delete Data for an External Data Cache Variable on a Service Event Orchestration',
    'description' => 'Delete Data for an External Data Cache Variable on a Service Event Orchestration Delete Data for an `external_data` type Cache Variable on a Service Event Orchestration. Use External Data type Cache Variables to store string, number, or boolean values via a dedicated API endpoint. These stored values can then be used in conditions or actions in Event Orchestration rules. For more information see the [Knowledge Base](https://support.pagerduty.com/main/docs/event-orchestration-cache-variables) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_incident_note' =>
  array (
    'slug' => 'pagerduty_delete_incident_note',
    'class' => 'PagerdutyDeleteIncidentNote',
    'method' => 'DELETE',
    'path' => '/incidents/{id}/notes/{note_id}',
    'operation_id' => 'deleteIncidentNote',
    'name' => 'Delete a note on an incident',
    'description' => 'Delete a note on an incident Delete an existing note for the specified incident. An incident represents a problem or an issue that needs to be addressed and resolved. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_incident_type_custom_field' =>
  array (
    'slug' => 'pagerduty_delete_incident_type_custom_field',
    'class' => 'PagerdutyDeleteIncidentTypeCustomField',
    'method' => 'DELETE',
    'path' => '/incidents/types/{type_id_or_name}/custom_fields/{field_id}',
    'operation_id' => 'deleteIncidentTypeCustomField',
    'name' => 'Delete a Custom Field for an Incident Type',
    'description' => 'Delete a Custom Field for an Incident Type Delete a custom field for an incident type. Custom Fields (CF) are a feature which will allow customers to extend Incidents with their own custom data, to provide additional context and support features such as customized filtering, search and analytics. Custom Fields can be applied to different incident types. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_incident_type_custom_field_field_option' =>
  array (
    'slug' => 'pagerduty_delete_incident_type_custom_field_field_option',
    'class' => 'PagerdutyDeleteIncidentTypeCustomFieldFieldOption',
    'method' => 'DELETE',
    'path' => '/incidents/types/{type_id_or_name}/custom_fields/{field_id}/field_options/{field_option_id}',
    'operation_id' => 'deleteIncidentTypeCustomFieldFieldOption',
    'name' => 'Delete a Field Option for a Custom Field',
    'description' => 'Delete a Field Option for a Custom Field Delete a field option for a custom field. Custom Fields (CF) are a feature which will allow customers to extend Incidents with their own custom data, to provide additional context and support features such as customized filtering, search and analytics. Custom Fields can be applied to different incident types. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_incident_workflow' =>
  array (
    'slug' => 'pagerduty_delete_incident_workflow',
    'class' => 'PagerdutyDeleteIncidentWorkflow',
    'method' => 'DELETE',
    'path' => '/incident_workflows/{id}',
    'operation_id' => 'deleteIncidentWorkflow',
    'name' => 'Delete an Incident Workflow',
    'description' => 'Delete an Incident Workflow Delete an existing Incident Workflow An Incident Workflow is a sequence of configurable Steps and associated Triggers that can execute automated Actions for a given Incident. Scoped OAuth requires: `incident_workflows.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_incident_workflow_trigger' =>
  array (
    'slug' => 'pagerduty_delete_incident_workflow_trigger',
    'class' => 'PagerdutyDeleteIncidentWorkflowTrigger',
    'method' => 'DELETE',
    'path' => '/incident_workflows/triggers/{id}',
    'operation_id' => 'deleteIncidentWorkflowTrigger',
    'name' => 'Delete a Trigger',
    'description' => 'Delete a Trigger Delete an existing Incident Workflow Trigger Scoped OAuth requires: `incident_workflows.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_maintenance_window' =>
  array (
    'slug' => 'pagerduty_delete_maintenance_window',
    'class' => 'PagerdutyDeleteMaintenanceWindow',
    'method' => 'DELETE',
    'path' => '/maintenance_windows/{id}',
    'operation_id' => 'deleteMaintenanceWindow',
    'name' => 'Delete or end a maintenance window',
    'description' => 'Delete or end a maintenance window Delete an existing maintenance window if it\'s in the future, or end it if it\'s currently on-going. If the maintenance window has already ended it cannot be deleted. A Maintenance Window is used to temporarily disable one or more Services for a set period of time. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#maintenance-windows) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_oauth_client' =>
  array (
    'slug' => 'pagerduty_delete_oauth_client',
    'class' => 'PagerdutyDeleteOauthClient',
    'method' => 'DELETE',
    'path' => '/webhook_subscriptions/oauth_clients/{id}',
    'operation_id' => 'deleteOauthClient',
    'name' => 'Delete an OAuth client',
    'description' => 'Delete an OAuth client. This will also remove the OAuth client association from any webhook subscriptions using it. Requires admin or owner role permissions.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_oauth_delegations' =>
  array (
    'slug' => 'pagerduty_delete_oauth_delegations',
    'class' => 'PagerdutyDeleteOauthDelegations',
    'method' => 'DELETE',
    'path' => '/oauth_delegations',
    'operation_id' => 'deleteOauthDelegations',
    'name' => 'Delete all OAuth delegations',
    'description' => 'Delete all OAuth delegations as per provided query parameters. An OAuth delegation represents an instance of a user or account\'s authorization to an app (via OAuth) to access their PagerDuty account. Common apps include the PagerDuty mobile app, Slack, Microsoft Teams, and third-party apps. It also represents a user session in the PagerDuty web app. Deleting an OAuth delegation will revoke that instance of an app\'s access to that user or account. To grant access again, reauthorization/reauthentication will be required. This endpoint supports deleting mobile app OAuth delegations for a given user, which is equivalent to signing users out of the mobile app. It also supports deleting delegations of type web, which is equivalent to signing users out of the web app. This is a synchronous API. Scoped OAuth requires: `oauth_delegations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_orchestration' =>
  array (
    'slug' => 'pagerduty_delete_orchestration',
    'class' => 'PagerdutyDeleteOrchestration',
    'method' => 'DELETE',
    'path' => '/event_orchestrations/{id}',
    'operation_id' => 'deleteOrchestration',
    'name' => 'Delete an Orchestration',
    'description' => 'Delete an Orchestration Delete a Global Event Orchestration. Once deleted, you will no longer be able to ingest events into PagerDuty using this Orchestration\'s Routing Key. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_orchestration_integration' =>
  array (
    'slug' => 'pagerduty_delete_orchestration_integration',
    'class' => 'PagerdutyDeleteOrchestrationIntegration',
    'method' => 'DELETE',
    'path' => '/event_orchestrations/{id}/integrations/{integration_id}',
    'operation_id' => 'deleteOrchestrationIntegration',
    'name' => 'Delete an Integration for an Event Orchestration',
    'description' => 'Delete an Integration for an Event Orchestration Delete an Integration and its associated Routing Key. Once deleted, PagerDuty will drop all future events sent to PagerDuty using the Routing Key. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_override' =>
  array (
    'slug' => 'pagerduty_delete_override',
    'class' => 'PagerdutyDeleteOverride',
    'method' => 'DELETE',
    'path' => '/v3/schedules/{id}/overrides/{override_id}',
    'operation_id' => 'deleteOverride',
    'name' => 'Delete an override',
    'description' => 'Delete an override <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Delete an override by ID.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_rotation' =>
  array (
    'slug' => 'pagerduty_delete_rotation',
    'class' => 'PagerdutyDeleteRotation',
    'method' => 'DELETE',
    'path' => '/v3/schedules/{id}/rotations/{rotation_id}',
    'operation_id' => 'deleteRotation',
    'name' => 'Delete a rotation',
    'description' => 'Delete a rotation <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Delete a rotation and all its events. On deletion, past events are preserved in the audit history, the current active event is truncated to the deletion time, and future events are removed.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_ruleset' =>
  array (
    'slug' => 'pagerduty_delete_ruleset',
    'class' => 'PagerdutyDeleteRuleset',
    'method' => 'DELETE',
    'path' => '/rulesets/{id}',
    'operation_id' => 'deleteRuleset',
    'name' => 'Delete a Ruleset',
    'description' => 'Delete a Ruleset. <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Rulesets allow you to route events to an endpoint and create collections of Event Rules, which define sets of actions to take based on event content. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#rulesets) Scoped OAuth requires: `event_rules.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_ruleset_event_rule' =>
  array (
    'slug' => 'pagerduty_delete_ruleset_event_rule',
    'class' => 'PagerdutyDeleteRulesetEventRule',
    'method' => 'DELETE',
    'path' => '/rulesets/{id}/rules/{rule_id}',
    'operation_id' => 'deleteRulesetEventRule',
    'name' => 'Delete an Event Rule',
    'description' => 'Delete an Event Rule. <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Rulesets allow you to route events to an endpoint and create collections of Event Rules, which define sets of actions to take based on event content. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#rulesets) Scoped OAuth requires: `event_rules.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_schedule' =>
  array (
    'slug' => 'pagerduty_delete_schedule',
    'class' => 'PagerdutyDeleteSchedule',
    'method' => 'DELETE',
    'path' => '/schedules/{id}',
    'operation_id' => 'deleteSchedule',
    'name' => 'Delete a schedule',
    'description' => 'Delete a schedule Delete an on-call schedule. A Schedule determines the time periods that users are On-Call. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#schedules) Scoped OAuth requires: `schedules.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_schedule_override' =>
  array (
    'slug' => 'pagerduty_delete_schedule_override',
    'class' => 'PagerdutyDeleteScheduleOverride',
    'method' => 'DELETE',
    'path' => '/schedules/{id}/overrides/{override_id}',
    'operation_id' => 'deleteScheduleOverride',
    'name' => 'Delete an override',
    'description' => 'Delete an override Remove an override. You cannot remove a past override. If the override start time is before the current time, but the end time is after the current time, the override will be truncated to the current time. If the override is truncated, the status code will be 200 OK, as opposed to a 204 No Content for a successful delete. A Schedule determines the time periods that users are On-Call. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#schedules) Scoped OAuth requires: `schedules.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_schedule_v3' =>
  array (
    'slug' => 'pagerduty_delete_schedule_v3',
    'class' => 'PagerdutyDeleteScheduleV3',
    'method' => 'DELETE',
    'path' => '/v3/schedules/{id}',
    'operation_id' => 'deleteScheduleV3',
    'name' => 'Delete a schedule',
    'description' => 'Delete a schedule <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Delete a schedule and all associated rotations and events. If the schedule is referenced by an active escalation policy, the deletion will be rejected.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_service' =>
  array (
    'slug' => 'pagerduty_delete_service',
    'class' => 'PagerdutyDeleteService',
    'method' => 'DELETE',
    'path' => '/services/{id}',
    'operation_id' => 'deleteService',
    'name' => 'Delete a service',
    'description' => 'Delete a service Delete an existing service. Once the service is deleted, it will not be accessible from the web UI and new incidents won\'t be able to be created for this service. A service may represent an application, component, or team you wish to open incidents against. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#services) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_service_custom_field' =>
  array (
    'slug' => 'pagerduty_delete_service_custom_field',
    'class' => 'PagerdutyDeleteServiceCustomField',
    'method' => 'DELETE',
    'path' => '/services/custom_fields/{field_id}',
    'operation_id' => 'deleteServiceCustomField',
    'name' => 'Delete a Field',
    'description' => 'Delete a Field Delete a Custom Field from Services. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_service_custom_field_option' =>
  array (
    'slug' => 'pagerduty_delete_service_custom_field_option',
    'class' => 'PagerdutyDeleteServiceCustomFieldOption',
    'method' => 'DELETE',
    'path' => '/services/custom_fields/{field_id}/field_options/{field_option_id}',
    'operation_id' => 'deleteServiceCustomFieldOption',
    'name' => 'Delete a Field Option',
    'description' => 'Delete a Field Option Delete a field option. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_service_dependency' =>
  array (
    'slug' => 'pagerduty_delete_service_dependency',
    'class' => 'PagerdutyDeleteServiceDependency',
    'method' => 'POST',
    'path' => '/service_dependencies/disassociate',
    'operation_id' => 'deleteServiceDependency',
    'name' => 'Disassociate service dependencies',
    'description' => 'Disassociate service dependencies Disassociate dependencies between two services. Business services model capabilities that span multiple technical services and that may be owned by several different teams. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#business-services) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_delete_service_event_rule' =>
  array (
    'slug' => 'pagerduty_delete_service_event_rule',
    'class' => 'PagerdutyDeleteServiceEventRule',
    'method' => 'DELETE',
    'path' => '/services/{id}/rules/{rule_id}',
    'operation_id' => 'deleteServiceEventRule',
    'name' => 'Delete an Event Rule from a Service',
    'description' => 'Delete an Event Rule from a Service. <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_service_from_incident_workflow_trigger' =>
  array (
    'slug' => 'pagerduty_delete_service_from_incident_workflow_trigger',
    'class' => 'PagerdutyDeleteServiceFromIncidentWorkflowTrigger',
    'method' => 'DELETE',
    'path' => '/incident_workflows/triggers/{trigger_id}/services/{service_id}',
    'operation_id' => 'deleteServiceFromIncidentWorkflowTrigger',
    'name' => 'Dissociate a Trigger and Service',
    'description' => 'Dissociate a Trigger and Service Remove a an existing Service from an Incident Workflow Trigger Scoped OAuth requires: `incident_workflows.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_session_configurations' =>
  array (
    'slug' => 'pagerduty_delete_session_configurations',
    'class' => 'PagerdutyDeleteSessionConfigurations',
    'method' => 'DELETE',
    'path' => '/session_configurations',
    'operation_id' => 'deleteSessionConfigurations',
    'name' => 'Delete an account\'s session configurations.',
    'description' => 'Delete an account\'s session configurations. Deletes the session configurations for a PagerDuty account that was previously set. The type parameter is required and specifies which configurations to delete. A single type (\'mobile\' or \'web\') or comma-separated list may be passed in. Scoped OAuth requires: `session_configurations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_sre_memory' =>
  array (
    'slug' => 'pagerduty_delete_sre_memory',
    'class' => 'PagerdutyDeleteSreMemory',
    'method' => 'DELETE',
    'path' => '/sre_agent/memories/{id}',
    'operation_id' => 'deleteSreMemory',
    'name' => 'Delete an SRE Agent memory',
    'description' => 'Delete an SRE Agent memory Permanently delete an SRE Agent memory. Scoped OAuth requires: `sre_agent.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_status_page_post' =>
  array (
    'slug' => 'pagerduty_delete_status_page_post',
    'class' => 'PagerdutyDeleteStatusPagePost',
    'method' => 'DELETE',
    'path' => '/status_pages/{id}/posts/{post_id}',
    'operation_id' => 'deleteStatusPagePost',
    'name' => 'Delete a Status Page Post',
    'description' => 'Delete a Status Page Post Delete a Post for a Status Page by Status Page ID and Post ID. Scoped OAuth requires: `status_pages.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_status_page_post_update' =>
  array (
    'slug' => 'pagerduty_delete_status_page_post_update',
    'class' => 'PagerdutyDeleteStatusPagePostUpdate',
    'method' => 'DELETE',
    'path' => '/status_pages/{id}/posts/{post_id}/post_updates/{post_update_id}',
    'operation_id' => 'deleteStatusPagePostUpdate',
    'name' => 'Delete a Status Page Post Update',
    'description' => 'Delete a Status Page Post Update Delete a Post Update for a Post by Post ID and Post Update ID. Scoped OAuth requires: `status_pages.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_status_page_postmortem' =>
  array (
    'slug' => 'pagerduty_delete_status_page_postmortem',
    'class' => 'PagerdutyDeleteStatusPagePostmortem',
    'method' => 'DELETE',
    'path' => '/status_pages/{id}/posts/{post_id}/postmortem',
    'operation_id' => 'deleteStatusPagePostmortem',
    'name' => 'Delete a Post Postmortem',
    'description' => 'Delete a Post Postmortem Delete a Postmortem for a Post by Post ID. Scoped OAuth requires: `status_pages.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_status_page_subscription' =>
  array (
    'slug' => 'pagerduty_delete_status_page_subscription',
    'class' => 'PagerdutyDeleteStatusPageSubscription',
    'method' => 'DELETE',
    'path' => '/status_pages/{id}/subscriptions/{subscription_id}',
    'operation_id' => 'deleteStatusPageSubscription',
    'name' => 'Delete a Status Page Subscription',
    'description' => 'Delete a Status Page Subscription Delete a Subscription for a Status Page by Status Page ID and Subscription ID. Scoped OAuth requires: `status_pages.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_tag' =>
  array (
    'slug' => 'pagerduty_delete_tag',
    'class' => 'PagerdutyDeleteTag',
    'method' => 'DELETE',
    'path' => '/tags/{id}',
    'operation_id' => 'deleteTag',
    'name' => 'Delete a tag',
    'description' => 'Delete a tag Remove an existing Tag. A Tag is applied to Escalation Policies, Teams or Users and can be used to filter them. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#tags) Scoped OAuth requires: `tags.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_team' =>
  array (
    'slug' => 'pagerduty_delete_team',
    'class' => 'PagerdutyDeleteTeam',
    'method' => 'DELETE',
    'path' => '/teams/{id}',
    'operation_id' => 'deleteTeam',
    'name' => 'Delete a team',
    'description' => 'Delete a team Remove an existing team. Succeeds only if the team has no associated Escalation Policies, Services, Schedules and Subteams. All associated unresovled incidents will be reassigned to another team (if specified) or will loose team association, thus becoming account-level (with visibility implications). Note that the incidents reassignment process is asynchronous and has no guarantee to complete before the API call return. A team is a collection of Users and Escalation Policies that represent a group of people within an organization. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#teams) Scoped OAuth requires: `teams.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_team_escalation_policy' =>
  array (
    'slug' => 'pagerduty_delete_team_escalation_policy',
    'class' => 'PagerdutyDeleteTeamEscalationPolicy',
    'method' => 'DELETE',
    'path' => '/teams/{id}/escalation_policies/{escalation_policy_id}',
    'operation_id' => 'deleteTeamEscalationPolicy',
    'name' => 'Remove an escalation policy from a team',
    'description' => 'Remove an escalation policy from a team. A team is a collection of Users and Escalation Policies that represent a group of people within an organization. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#teams) Scoped OAuth requires: `teams.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_team_user' =>
  array (
    'slug' => 'pagerduty_delete_team_user',
    'class' => 'PagerdutyDeleteTeamUser',
    'method' => 'DELETE',
    'path' => '/teams/{id}/users/{user_id}',
    'operation_id' => 'deleteTeamUser',
    'name' => 'Remove a user from a team',
    'description' => 'Remove a user from a team. A team is a collection of Users and Escalation Policies that represent a group of people within an organization. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#teams) Scoped OAuth requires: `teams.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_template' =>
  array (
    'slug' => 'pagerduty_delete_template',
    'class' => 'PagerdutyDeleteTemplate',
    'method' => 'DELETE',
    'path' => '/templates/{id}',
    'operation_id' => 'deleteTemplate',
    'name' => 'Delete a template',
    'description' => 'Delete a template Delete a specific of templates on the account Scoped OAuth requires: `templates.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_user' =>
  array (
    'slug' => 'pagerduty_delete_user',
    'class' => 'PagerdutyDeleteUser',
    'method' => 'DELETE',
    'path' => '/users/{id}',
    'operation_id' => 'deleteUser',
    'name' => 'Delete a user',
    'description' => 'Delete a user Remove an existing user. Returns 400 if the user has assigned incidents unless your [pricing plan](https://www.pagerduty.com/pricing) has the `offboarding` feature and the account is [configured](https://support.pagerduty.com/docs/offboarding#section-additional-configurations) appropriately. Note that the incidents reassignment process is asynchronous and has no guarantee to complete before the api call return. [*Learn more about `offboarding` feature*](https://support.pagerduty.com/docs/offboarding). Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_user_contact_method' =>
  array (
    'slug' => 'pagerduty_delete_user_contact_method',
    'class' => 'PagerdutyDeleteUserContactMethod',
    'method' => 'DELETE',
    'path' => '/users/{id}/contact_methods/{contact_method_id}',
    'operation_id' => 'deleteUserContactMethod',
    'name' => 'Delete a user\'s contact method',
    'description' => 'Delete a user\'s contact method Remove a user\'s contact method. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users:contact_methods.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_user_handoff_notification_rule' =>
  array (
    'slug' => 'pagerduty_delete_user_handoff_notification_rule',
    'class' => 'PagerdutyDeleteUserHandoffNotificationRule',
    'method' => 'DELETE',
    'path' => '/users/{id}/oncall_handoff_notification_rules/{oncall_handoff_notification_rule_id}',
    'operation_id' => 'deleteUserHandoffNotificationRule',
    'name' => 'Delete a User\'s Handoff Notification rule',
    'description' => 'Delete a User\'s Handoff Notification rule Remove a User\'s Handoff Notification Rule. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_user_notification_rule' =>
  array (
    'slug' => 'pagerduty_delete_user_notification_rule',
    'class' => 'PagerdutyDeleteUserNotificationRule',
    'method' => 'DELETE',
    'path' => '/users/{id}/notification_rules/{notification_rule_id}',
    'operation_id' => 'deleteUserNotificationRule',
    'name' => 'Delete a user\'s notification rule',
    'description' => 'Delete a user\'s notification rule Remove a user\'s notification rule. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users:contact_methods.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_user_session' =>
  array (
    'slug' => 'pagerduty_delete_user_session',
    'class' => 'PagerdutyDeleteUserSession',
    'method' => 'DELETE',
    'path' => '/users/{id}/sessions/{type}/{session_id}',
    'operation_id' => 'deleteUserSession',
    'name' => 'Delete a user\'s session',
    'description' => 'Delete a user\'s session <!-- theme: warning --> > ### Deprecated > This endpoint is deprecated as OAuth token revocation is now synchronous. Please use the [DELETE /oauth_delegations endpoint](https://developer.pagerduty.com/api-reference/ad1161db75db1-delete-all-o-auth-delegations) instead. Delete a user\'s session. Beginning November 2021, user sessions no longer includes newly issued OAuth tokens. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users:sessions.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_user_sessions' =>
  array (
    'slug' => 'pagerduty_delete_user_sessions',
    'class' => 'PagerdutyDeleteUserSessions',
    'method' => 'DELETE',
    'path' => '/users/{id}/sessions',
    'operation_id' => 'deleteUserSessions',
    'name' => 'Delete all user sessions',
    'description' => 'Delete all user sessions <!-- theme: warning --> > ### Deprecated > This endpoint is deprecated as OAuth token revocation is now synchronous. Please use the [DELETE /oauth_delegations endpoint](https://developer.pagerduty.com/api-reference/ad1161db75db1-delete-all-o-auth-delegations) instead. Delete all user sessions. Beginning November 2021, user sessions no longer includes newly issued OAuth tokens. If you are interested in deleting mobile app sessions, refer to the Delete OAuth Delegations endpoint. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users:sessions.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_user_status_update_notification_rule' =>
  array (
    'slug' => 'pagerduty_delete_user_status_update_notification_rule',
    'class' => 'PagerdutyDeleteUserStatusUpdateNotificationRule',
    'method' => 'DELETE',
    'path' => '/users/{id}/status_update_notification_rules/{status_update_notification_rule_id}',
    'operation_id' => 'deleteUserStatusUpdateNotificationRule',
    'name' => 'Delete a user\'s status update notification rule',
    'description' => 'Delete a user\'s status update notification rule Remove a user\'s status update notification rule. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_webhook_subscription' =>
  array (
    'slug' => 'pagerduty_delete_webhook_subscription',
    'class' => 'PagerdutyDeleteWebhookSubscription',
    'method' => 'DELETE',
    'path' => '/webhook_subscriptions/{id}',
    'operation_id' => 'deleteWebhookSubscription',
    'name' => 'Delete a webhook subscription',
    'description' => 'Delete a webhook subscription Deletes a webhook subscription. Scoped OAuth requires: `webhook_subscriptions.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_delete_workflow_integration_connection' =>
  array (
    'slug' => 'pagerduty_delete_workflow_integration_connection',
    'class' => 'PagerdutyDeleteWorkflowIntegrationConnection',
    'method' => 'DELETE',
    'path' => '/workflows/integrations/{integration_id}/connections/{id}',
    'operation_id' => 'deleteWorkflowIntegrationConnection',
    'name' => 'Delete Workflow Integration Connection',
    'description' => 'Delete Workflow Integration Connection Delete a Workflow Integration Connection. Scoped OAuth requires: `workflow_integrations:connections.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_enable_extension' =>
  array (
    'slug' => 'pagerduty_enable_extension',
    'class' => 'PagerdutyEnableExtension',
    'method' => 'POST',
    'path' => '/extensions/{id}/enable',
    'operation_id' => 'enableExtension',
    'name' => 'Enable an extension',
    'description' => 'Enable an extension that is temporarily disabled. (This API does not require a request body.) Extensions are representations of Extension Schema objects that are attached to Services. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#extensions) Scoped OAuth requires: `extensions.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_enable_webhook_subscription' =>
  array (
    'slug' => 'pagerduty_enable_webhook_subscription',
    'class' => 'PagerdutyEnableWebhookSubscription',
    'method' => 'POST',
    'path' => '/webhook_subscriptions/{id}/enable',
    'operation_id' => 'enableWebhookSubscription',
    'name' => 'Enable a webhook subscription',
    'description' => 'Enable a webhook subscription that is temporarily disabled. (This API does not require a request body.) Webhook subscriptions can become temporarily disabled when the subscription\'s delivery method is repeatedly rejected by the server. Scoped OAuth requires: `webhook_subscriptions.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_ability' =>
  array (
    'slug' => 'pagerduty_get_ability',
    'class' => 'PagerdutyGetAbility',
    'method' => 'GET',
    'path' => '/abilities/{id}',
    'operation_id' => 'getAbility',
    'name' => 'Test an ability',
    'description' => 'Test an ability Test whether your account has a given ability. "Abilities" describes your account\'s capabilities by feature name. For example `"teams"`. An ability may be available to your account based on things like your pricing plan or account state. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#abilities) Scoped OAuth requires: `abilities.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_addon' =>
  array (
    'slug' => 'pagerduty_get_addon',
    'class' => 'PagerdutyGetAddon',
    'method' => 'GET',
    'path' => '/addons/{id}',
    'operation_id' => 'getAddon',
    'name' => 'Get an Add-on',
    'description' => 'Get an Add-on Get details about an existing Add-on. Addon\'s are pieces of functionality that developers can write to insert new functionality into PagerDuty\'s UI. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#add-ons) Scoped OAuth requires: `addons.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_alert_grouping_setting' =>
  array (
    'slug' => 'pagerduty_get_alert_grouping_setting',
    'class' => 'PagerdutyGetAlertGroupingSetting',
    'method' => 'GET',
    'path' => '/alert_grouping_settings/{id}',
    'operation_id' => 'getAlertGroupingSetting',
    'name' => 'Get an Alert Grouping Setting',
    'description' => 'Get an Alert Grouping Setting Get an existing Alert Grouping Setting. The settings part of Alert Grouper service allows us to create Alert Grouping Settings and configs that are required to be used during grouping of the alerts. Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_all_automation_actions' =>
  array (
    'slug' => 'pagerduty_get_all_automation_actions',
    'class' => 'PagerdutyGetAllAutomationActions',
    'method' => 'GET',
    'path' => '/automation_actions/actions',
    'operation_id' => 'getAllAutomationActions',
    'name' => 'List Automation Actions',
    'description' => 'List Automation Actions Lists Automation Actions matching provided query params. The returned records are sorted by action name in alphabetical order. See [`Cursor-based pagination`](https://developer.pagerduty.com/docs/rest-api-v2/pagination/) for instructions on how to paginate through the result set.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_analytics_incident_responses_by_id' =>
  array (
    'slug' => 'pagerduty_get_analytics_incident_responses_by_id',
    'class' => 'PagerdutyGetAnalyticsIncidentResponsesById',
    'method' => 'GET',
    'path' => '/analytics/raw/incidents/{id}/responses',
    'operation_id' => 'getAnalyticsIncidentResponsesById',
    'name' => 'Get raw responses from a single incident',
    'description' => 'Get raw responses from a single incident Provides enriched responder data for a single incident. Example metrics include Time to Respond, Responder Type, and Response Status. See metric definitions below. <!-- theme: info --> > **Note:** Analytics data is updated once per day. It takes up to 24 hours before new incident responses appear in the Analytics API. Scoped OAuth requires: `analytics.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_analytics_incidents' =>
  array (
    'slug' => 'pagerduty_get_analytics_incidents',
    'class' => 'PagerdutyGetAnalyticsIncidents',
    'method' => 'POST',
    'path' => '/analytics/raw/incidents',
    'operation_id' => 'getAnalyticsIncidents',
    'name' => 'Get raw data - multiple incidents',
    'description' => 'Get raw data - multiple incidents Provides enriched incident data and metrics for multiple incidents. Example metrics include Seconds to Resolve, Seconds to Engage, Snoozed Seconds, and Sleep Hour Interruptions. Metric definitions can be found in our [Knowledge Base](https://support.pagerduty.com/docs/insights#incidents-list). <!-- theme: info --> > A `team_ids` or `service_ids` filter is required for [user-level API keys](https://support.pagerduty.com/docs/using-the-api#section-generating-a-personal-rest-api-key) or keys generated through an OAuth flow. Account-level API keys do not have this requirement. <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new incidents appear in the Analytics API. Scoped OAuth requires: `analytics.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters and filters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_analytics_incidents_by_id' =>
  array (
    'slug' => 'pagerduty_get_analytics_incidents_by_id',
    'class' => 'PagerdutyGetAnalyticsIncidentsById',
    'method' => 'GET',
    'path' => '/analytics/raw/incidents/{id}',
    'operation_id' => 'getAnalyticsIncidentsById',
    'name' => 'Get raw data - single incident',
    'description' => 'Get raw data - single incident Provides enriched incident data and metrics for a single incident. Example metrics include Seconds to Resolve, Seconds to Engage, Snoozed Seconds, and Sleep Hour Interruptions. Metric definitions can be found in our [Knowledge Base](https://support.pagerduty.com/docs/insights#incidents-list). <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new incidents appear in the Analytics API. Scoped OAuth requires: `analytics.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_analytics_metrics_incidents_all' =>
  array (
    'slug' => 'pagerduty_get_analytics_metrics_incidents_all',
    'class' => 'PagerdutyGetAnalyticsMetricsIncidentsAll',
    'method' => 'POST',
    'path' => '/analytics/metrics/incidents/all',
    'operation_id' => 'getAnalyticsMetricsIncidentsAll',
    'name' => 'Get aggregated incident data',
    'description' => 'Get aggregated incident data Provides aggregated enriched metrics for incidents. The provided metrics are aggregated by day, week, month using the aggregate_unit parameter, or for the entire period if no aggregate_unit is provided. <!-- theme: info --> > A `team_ids` or `service_ids` filter is required for [user-level API keys](https://support.pagerduty.com/docs/using-the-api#section-generating-a-personal-rest-api-key) or keys generated through an OAuth flow. Account-level API keys do not have this requirement. <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new incidents appear in the Analytics API. Scoped OAuth requires: `analytics.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters and filters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_analytics_metrics_incidents_escalation_policy' =>
  array (
    'slug' => 'pagerduty_get_analytics_metrics_incidents_escalation_policy',
    'class' => 'PagerdutyGetAnalyticsMetricsIncidentsEscalationPolicy',
    'method' => 'POST',
    'path' => '/analytics/metrics/incidents/escalation_policies',
    'operation_id' => 'getAnalyticsMetricsIncidentsEscalationPolicy',
    'name' => 'Get aggregated escalation policy data',
    'description' => 'Get aggregated escalation policy data Provides aggregated metrics for incidents aggregated into units of time by escalation policy. Example metrics include Seconds to Resolve, Seconds to Engage, Snoozed Seconds, and Sleep Hour Interruptions. Metric definitions can be found in our [Knowledge Base](https://support.pagerduty.com/docs/insights#escalation-policy-list). <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new incidents appear in the Analytics API. Scoped OAuth requires: `analytics.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters and filters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_analytics_metrics_incidents_escalation_policy_all' =>
  array (
    'slug' => 'pagerduty_get_analytics_metrics_incidents_escalation_policy_all',
    'class' => 'PagerdutyGetAnalyticsMetricsIncidentsEscalationPolicyAll',
    'method' => 'POST',
    'path' => '/analytics/metrics/incidents/escalation_policies/all',
    'operation_id' => 'getAnalyticsMetricsIncidentsEscalationPolicyAll',
    'name' => 'Get aggregated metrics for all escalation policies',
    'description' => 'Get aggregated metrics for all escalation policies Provides aggregated metrics across all escalation policies. Example metrics include Seconds to Resolve, Seconds to Engage, Snoozed Seconds, and Sleep Hour Interruptions. Metric definitions can be found in our [Knowledge Base](https://support.pagerduty.com/docs/insights#escalation-policy-list). <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new incidents appear in the Analytics API. Scoped OAuth requires: `analytics.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters and filters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_analytics_metrics_incidents_service' =>
  array (
    'slug' => 'pagerduty_get_analytics_metrics_incidents_service',
    'class' => 'PagerdutyGetAnalyticsMetricsIncidentsService',
    'method' => 'POST',
    'path' => '/analytics/metrics/incidents/services',
    'operation_id' => 'getAnalyticsMetricsIncidentsService',
    'name' => 'Get aggregated service data',
    'description' => 'Get aggregated service data Provides aggregated metrics for incidents aggregated into units of time by service. Example metrics include Seconds to Resolve, Seconds to Engage, Snoozed Seconds, and Sleep Hour Interruptions. Metric definitions can be found in our [Knowledge Base](https://support.pagerduty.com/docs/insights#services-list). Data can be aggregated by day, week or month in addition to by service, or provided just as a collection of aggregates for each service in the dataset for the entire period. If a unit is provided, each row in the returned dataset will include a \'range_start\' timestamp. <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new incidents appear in the Analytics API. Scoped OAuth requires: `analytics.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters and filters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_analytics_metrics_incidents_service_all' =>
  array (
    'slug' => 'pagerduty_get_analytics_metrics_incidents_service_all',
    'class' => 'PagerdutyGetAnalyticsMetricsIncidentsServiceAll',
    'method' => 'POST',
    'path' => '/analytics/metrics/incidents/services/all',
    'operation_id' => 'getAnalyticsMetricsIncidentsServiceAll',
    'name' => 'Get aggregated metrics for all services',
    'description' => 'Get aggregated metrics for all services Provides aggregated metrics across all services. Example metrics include Seconds to Resolve, Seconds to Engage, Snoozed Seconds, and Sleep Hour Interruptions. Metric definitions can be found in our [Knowledge Base](https://support.pagerduty.com/docs/insights#services-list). <!-- theme: info --> > A `team_ids` or `service_ids` filter is required for [user-level API keys](https://support.pagerduty.com/docs/using-the-api#section-generating-a-personal-rest-api-key) or keys generated through an OAuth flow. Account-level API keys do not have this requirement. <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new incidents appear in the Analytics API. Scoped OAuth requires: `analytics.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters and filters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_analytics_metrics_incidents_team' =>
  array (
    'slug' => 'pagerduty_get_analytics_metrics_incidents_team',
    'class' => 'PagerdutyGetAnalyticsMetricsIncidentsTeam',
    'method' => 'POST',
    'path' => '/analytics/metrics/incidents/teams',
    'operation_id' => 'getAnalyticsMetricsIncidentsTeam',
    'name' => 'Get aggregated team data',
    'description' => 'Get aggregated team data Provides aggregated metrics for incidents aggregated into units of time by team. Example metrics include Seconds to Resolve, Seconds to Engage, Snoozed Seconds, and Sleep Hour Interruptions. Metric definitions can be found in our [Knowledge Base](https://support.pagerduty.com/docs/insights#teams-list). Data can be aggregated by day, week or month in addition to by team, or provided just as a collection of aggregates for each team in the dataset for the entire period. If a unit is provided, each row in the returned dataset will include a \'range_start\' timestamp. <!-- theme: info --> > A `team_ids` or `service_ids` filter is required for [user-level API keys](https://support.pagerduty.com/docs/using-the-api#section-generating-a-personal-rest-api-key) or keys generated through an OAuth flow. Account-level API keys do not have this requirement. <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new incidents appear in the Analytics API. Scoped OAuth requires: `analytics.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters and filters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_analytics_metrics_incidents_team_all' =>
  array (
    'slug' => 'pagerduty_get_analytics_metrics_incidents_team_all',
    'class' => 'PagerdutyGetAnalyticsMetricsIncidentsTeamAll',
    'method' => 'POST',
    'path' => '/analytics/metrics/incidents/teams/all',
    'operation_id' => 'getAnalyticsMetricsIncidentsTeamAll',
    'name' => 'Get aggregated metrics for all teams',
    'description' => 'Get aggregated metrics for all teams Provides aggregated metrics across all teams. Example metrics include Seconds to Resolve, Seconds to Engage, Snoozed Seconds, and Sleep Hour Interruptions. Metric definitions can be found in our [Knowledge Base](https://support.pagerduty.com/docs/insights#teams-list). <!-- theme: info --> > A `team_ids` or `service_ids` filter is required for [user-level API keys](https://support.pagerduty.com/docs/using-the-api#section-generating-a-personal-rest-api-key) or keys generated through an OAuth flow. Account-level API keys do not have this requirement. <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new incidents appear in the Analytics API. Scoped OAuth requires: `analytics.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters and filters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_analytics_metrics_pd_advance_usage_features' =>
  array (
    'slug' => 'pagerduty_get_analytics_metrics_pd_advance_usage_features',
    'class' => 'PagerdutyGetAnalyticsMetricsPdAdvanceUsageFeatures',
    'method' => 'POST',
    'path' => '/analytics/metrics/pd_advance_usage/features',
    'operation_id' => 'getAnalyticsMetricsPdAdvanceUsageFeatures',
    'name' => 'Get aggregated PD Advance usage data',
    'description' => 'Get aggregated PD Advance usage data Provides aggregated metrics for the usage of PD Advance. <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new incidents appear in the Analytics API. Scoped OAuth requires: `analytics.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters and filters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_analytics_metrics_responders_all' =>
  array (
    'slug' => 'pagerduty_get_analytics_metrics_responders_all',
    'class' => 'PagerdutyGetAnalyticsMetricsRespondersAll',
    'method' => 'POST',
    'path' => '/analytics/metrics/responders/all',
    'operation_id' => 'getAnalyticsMetricsRespondersAll',
    'name' => 'Get aggregated metrics for all responders',
    'description' => 'Get aggregated metrics for all responders Provides aggregated incident metrics for all selected responders. Example metrics include Seconds to Resolve, Seconds to Engage, Snoozed Seconds, and Sleep Hour Interruptions. Metric definitions can be found in our [Knowledge Base](https://support.pagerduty.com/docs/insights#responders-list). <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new incidents appear in the Analytics API. Scoped OAuth requires: `analytics.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters and filters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_analytics_metrics_responders_team' =>
  array (
    'slug' => 'pagerduty_get_analytics_metrics_responders_team',
    'class' => 'PagerdutyGetAnalyticsMetricsRespondersTeam',
    'method' => 'POST',
    'path' => '/analytics/metrics/responders/teams',
    'operation_id' => 'getAnalyticsMetricsRespondersTeam',
    'name' => 'Get responder data aggregated by team',
    'description' => 'Get responder data aggregated by team Provides incident metrics aggregated by responder. Example metrics include Seconds to Resolve, Seconds to Engage, Snoozed Seconds, and Sleep Hour Interruptions. Metric definitions can be found in our [Knowledge Base](https://support.pagerduty.com/docs/insights#responders-list). <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new incidents appear in the Analytics API. Scoped OAuth requires: `analytics.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters and filters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_analytics_metrics_users_all' =>
  array (
    'slug' => 'pagerduty_get_analytics_metrics_users_all',
    'class' => 'PagerdutyGetAnalyticsMetricsUsersAll',
    'method' => 'POST',
    'path' => '/analytics/metrics/users/all',
    'operation_id' => 'getAnalyticsMetricsUsersAll',
    'name' => 'Get aggregated metrics for all users',
    'description' => 'Get aggregated metrics for all users Provides aggregated metrics across all users within their account. This endpoint provides summary statistics about user activity and performance. <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new incidents appear in the Analytics API. Scoped OAuth requires: `analytics.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters and filters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_analytics_responder_incidents' =>
  array (
    'slug' => 'pagerduty_get_analytics_responder_incidents',
    'class' => 'PagerdutyGetAnalyticsResponderIncidents',
    'method' => 'POST',
    'path' => '/analytics/raw/responders/{responder_id}/incidents',
    'operation_id' => 'getAnalyticsResponderIncidents',
    'name' => 'Get raw incidents for a single responder_id',
    'description' => 'Get raw incidents for a single responder_id Provides enriched incident data and metrics for a specific responder. Example metrics include Mean Seconds to Resolve, Mean Seconds to Engage, Snoozed Seconds, and Sleep Hour Interruptions. Metric definitions can be found in our [Knowledge Base](https://support.pagerduty.com/docs/insights#incidents-list). <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new incidents appear in the Analytics API. Scoped OAuth requires: `analytics.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters and filters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_analytics_users' =>
  array (
    'slug' => 'pagerduty_get_analytics_users',
    'class' => 'PagerdutyGetAnalyticsUsers',
    'method' => 'POST',
    'path' => '/analytics/raw/users',
    'operation_id' => 'getAnalyticsUsers',
    'name' => 'Get raw user analytics data',
    'description' => 'Get raw user analytics data Allows users to retrieve a raw list of user analytics data within their account. This endpoint provides detailed data about user activity and account configuration. <!-- theme: info --> > **Note:** Analytics data is updated [periodically](https://support.pagerduty.com/main/docs/insights#:~:text=Data%20Update%20Schedule). It takes up to 24 hours before new user data appears in the Analytics API. Scoped OAuth requires: `analytics.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Parameters and filters to apply to the dataset.',
    ),
  ),
  'pagerduty_get_automation_action' =>
  array (
    'slug' => 'pagerduty_get_automation_action',
    'class' => 'PagerdutyGetAutomationAction',
    'method' => 'GET',
    'path' => '/automation_actions/actions/{id}',
    'operation_id' => 'getAutomationAction',
    'name' => 'Get an Automation Action',
    'description' => 'Get an Automation Action',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_automation_actions_action_service_association' =>
  array (
    'slug' => 'pagerduty_get_automation_actions_action_service_association',
    'class' => 'PagerdutyGetAutomationActionsActionServiceAssociation',
    'method' => 'GET',
    'path' => '/automation_actions/actions/{id}/services/{service_id}',
    'operation_id' => 'getAutomationActionsActionServiceAssociation',
    'name' => 'Get the details of an Automation Action / service relation',
    'description' => 'Get the details of an Automation Action / service relation Gets the details of a Automation Action / service relation',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_automation_actions_action_service_associations' =>
  array (
    'slug' => 'pagerduty_get_automation_actions_action_service_associations',
    'class' => 'PagerdutyGetAutomationActionsActionServiceAssociations',
    'method' => 'GET',
    'path' => '/automation_actions/actions/{id}/services',
    'operation_id' => 'getAutomationActionsActionServiceAssociations',
    'name' => 'Get all service references associated with an Automation Action',
    'description' => 'Get all service references associated with an Automation Action Gets all service references associated with an Automation Action',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_automation_actions_action_team_association' =>
  array (
    'slug' => 'pagerduty_get_automation_actions_action_team_association',
    'class' => 'PagerdutyGetAutomationActionsActionTeamAssociation',
    'method' => 'GET',
    'path' => '/automation_actions/actions/{id}/teams/{team_id}',
    'operation_id' => 'getAutomationActionsActionTeamAssociation',
    'name' => 'Get the details of an Automation Action / team relation',
    'description' => 'Get the details of an Automation Action / team relation Gets the details of an Automation Action / team relation',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_automation_actions_action_team_associations' =>
  array (
    'slug' => 'pagerduty_get_automation_actions_action_team_associations',
    'class' => 'PagerdutyGetAutomationActionsActionTeamAssociations',
    'method' => 'GET',
    'path' => '/automation_actions/actions/{id}/teams',
    'operation_id' => 'getAutomationActionsActionTeamAssociations',
    'name' => 'Get all team references associated with an Automation Action',
    'description' => 'Get all team references associated with an Automation Action Gets all team references associated with an Automation Action',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_automation_actions_invocation' =>
  array (
    'slug' => 'pagerduty_get_automation_actions_invocation',
    'class' => 'PagerdutyGetAutomationActionsInvocation',
    'method' => 'GET',
    'path' => '/automation_actions/invocations/{id}',
    'operation_id' => 'getAutomationActionsInvocation',
    'name' => 'Get an Invocation',
    'description' => 'Get an Invocation Get an Automation Action Invocation',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_automation_actions_runner' =>
  array (
    'slug' => 'pagerduty_get_automation_actions_runner',
    'class' => 'PagerdutyGetAutomationActionsRunner',
    'method' => 'GET',
    'path' => '/automation_actions/runners/{id}',
    'operation_id' => 'getAutomationActionsRunner',
    'name' => 'Get an Automation Action runner',
    'description' => 'Get an Automation Action runner',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_automation_actions_runner_team_association' =>
  array (
    'slug' => 'pagerduty_get_automation_actions_runner_team_association',
    'class' => 'PagerdutyGetAutomationActionsRunnerTeamAssociation',
    'method' => 'GET',
    'path' => '/automation_actions/runners/{id}/teams/{team_id}',
    'operation_id' => 'getAutomationActionsRunnerTeamAssociation',
    'name' => 'Get the details of a runner / team relation',
    'description' => 'Get the details of a runner / team relation Gets the details of a runner / team relation',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_automation_actions_runner_team_associations' =>
  array (
    'slug' => 'pagerduty_get_automation_actions_runner_team_associations',
    'class' => 'PagerdutyGetAutomationActionsRunnerTeamAssociations',
    'method' => 'GET',
    'path' => '/automation_actions/runners/{id}/teams',
    'operation_id' => 'getAutomationActionsRunnerTeamAssociations',
    'name' => 'Get all team references associated with a runner',
    'description' => 'Get all team references associated with a runner Gets all team references associated with a runner',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_automation_actions_runners' =>
  array (
    'slug' => 'pagerduty_get_automation_actions_runners',
    'class' => 'PagerdutyGetAutomationActionsRunners',
    'method' => 'GET',
    'path' => '/automation_actions/runners',
    'operation_id' => 'getAutomationActionsRunners',
    'name' => 'List Automation Action runners',
    'description' => 'List Automation Action runners Lists Automation Action runners matching provided query params. The returned records are sorted by runner name in alphabetical order. See [`Cursor-based pagination`](https://developer.pagerduty.com/docs/rest-api-v2/pagination/) for instructions on how to paginate through the result set.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_business_service' =>
  array (
    'slug' => 'pagerduty_get_business_service',
    'class' => 'PagerdutyGetBusinessService',
    'method' => 'GET',
    'path' => '/business_services/{id}',
    'operation_id' => 'getBusinessService',
    'name' => 'Get a Business Service',
    'description' => 'Get a Business Service Get details about an existing Business Service. Business services model capabilities that span multiple technical services and that may be owned by several different teams. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#business-services) Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_business_service_impacts' =>
  array (
    'slug' => 'pagerduty_get_business_service_impacts',
    'class' => 'PagerdutyGetBusinessServiceImpacts',
    'method' => 'GET',
    'path' => '/business_services/impacts',
    'operation_id' => 'getBusinessServiceImpacts',
    'name' => 'List Business Services sorted by impacted status',
    'description' => 'List Business Services sorted by impacted status Retrieve a list top-level Business Services sorted by highest Impact with `status` included. When called without the `ids[]` parameter, this endpoint does not return an exhaustive list of Business Services but rather provides access to the most impacted up to the limit of 200. The returned Business Services are sorted first by Impact, secondarily by most recently impacted, and finally by name. To get impact information about a specific set of Business Services, use the `ids[]` parameter. Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_business_service_priority_thresholds' =>
  array (
    'slug' => 'pagerduty_get_business_service_priority_thresholds',
    'class' => 'PagerdutyGetBusinessServicePriorityThresholds',
    'method' => 'GET',
    'path' => '/business_services/priority_thresholds',
    'operation_id' => 'getBusinessServicePriorityThresholds',
    'name' => 'Get the global priority threshold for a Business Service to be considered impacted by an Incident',
    'description' => 'Get the global priority threshold for a Business Service to be considered impacted by an Incident Retrieves the priority threshold information for an account. Currently, there is a `global_threshold` that can be set for the account. Incidents that have a priority meeting or exceeding this threshold will be considered impacting on any Business Service that depends on the Service to which the Incident belongs. Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_business_service_service_dependencies' =>
  array (
    'slug' => 'pagerduty_get_business_service_service_dependencies',
    'class' => 'PagerdutyGetBusinessServiceServiceDependencies',
    'method' => 'GET',
    'path' => '/service_dependencies/business_services/{id}',
    'operation_id' => 'getBusinessServiceServiceDependencies',
    'name' => 'Get Business Service dependencies',
    'description' => 'Get Business Service dependencies Get all immediate dependencies of any Business Service. Business Services model capabilities that span multiple technical services and that may be owned by several different teams. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#business-services) Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_business_service_subscribers' =>
  array (
    'slug' => 'pagerduty_get_business_service_subscribers',
    'class' => 'PagerdutyGetBusinessServiceSubscribers',
    'method' => 'GET',
    'path' => '/business_services/{id}/subscribers',
    'operation_id' => 'getBusinessServiceSubscribers',
    'name' => 'List Business Service Subscribers',
    'description' => 'List Business Service Subscribers Retrieve a list of Notification Subscribers on the Business Service. <!-- theme: warning --> > Users must be added through `POST /business_services/{id}/subscribers` to be returned from this endpoint. Scoped OAuth requires: `subscribers.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_business_service_supporting_service_impacts' =>
  array (
    'slug' => 'pagerduty_get_business_service_supporting_service_impacts',
    'class' => 'PagerdutyGetBusinessServiceSupportingServiceImpacts',
    'method' => 'GET',
    'path' => '/business_services/{id}/supporting_services/impacts',
    'operation_id' => 'getBusinessServiceSupportingServiceImpacts',
    'name' => 'List the supporting Business Services for the given Business Service Id, sorted by impacted status.',
    'description' => 'List the supporting Business Services for the given Business Service Id, sorted by impacted status. Retrieve of Business Services that support the given Business Service sorted by highest Impact with `status` included. This endpoint does not return an exhaustive list of Business Services but rather provides access to the most impacted up to the limit of 200. The returned Business Services are sorted first by Impact, secondarily by most recently impacted, and finally by name. To get impact information about a specific set of Business Services, use the `ids[]` parameter on the `/business_services/impacts` endpoint. Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_business_service_top_level_impactors' =>
  array (
    'slug' => 'pagerduty_get_business_service_top_level_impactors',
    'class' => 'PagerdutyGetBusinessServiceTopLevelImpactors',
    'method' => 'GET',
    'path' => '/business_services/impactors',
    'operation_id' => 'getBusinessServiceTopLevelImpactors',
    'name' => 'List Impactors affecting Business Services',
    'description' => 'List Impactors affecting Business Services Retrieve a list of Impactors for the top-level Business Services on the account. Impactors are currently limited to Incidents. This endpoint does not return an exhaustive list of Impactors but rather provides access to the highest priority Impactors for the Business Services in question up to the limit of 200. To get Impactors for a specific set of Business Services, use the `ids[]` parameter. The returned Impactors are sorted first by priority and secondarily by their creation date. Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_cache_var_on_global_orch' =>
  array (
    'slug' => 'pagerduty_get_cache_var_on_global_orch',
    'class' => 'PagerdutyGetCacheVarOnGlobalOrch',
    'method' => 'GET',
    'path' => '/event_orchestrations/{id}/cache_variables/{cache_variable_id}',
    'operation_id' => 'getCacheVarOnGlobalOrch',
    'name' => 'Get a Cache Variable for a Global Event Orchestration',
    'description' => 'Get a Cache Variable for a Global Event Orchestration. Cache Variables allow you to store event data on an Event Orchestration, which can then be used in Event Orchestration rules as part of conditions or actions. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_cache_var_on_service_orch' =>
  array (
    'slug' => 'pagerduty_get_cache_var_on_service_orch',
    'class' => 'PagerdutyGetCacheVarOnServiceOrch',
    'method' => 'GET',
    'path' => '/event_orchestrations/services/{service_id}/cache_variables/{cache_variable_id}',
    'operation_id' => 'getCacheVarOnServiceOrch',
    'name' => 'Get a Cache Variable for a Service Event Orchestration',
    'description' => 'Get a Cache Variable for a Service Event Orchestration. Cache Variables allow you to store event data on an Event Orchestration, which can then be used in Event Orchestration rules as part of conditions or actions. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_change_event' =>
  array (
    'slug' => 'pagerduty_get_change_event',
    'class' => 'PagerdutyGetChangeEvent',
    'method' => 'GET',
    'path' => '/change_events/{id}',
    'operation_id' => 'getChangeEvent',
    'name' => 'Get a Change Event',
    'description' => 'Get a Change Event Get details about an existing Change Event. Scoped OAuth requires: `change_events.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_current_user' =>
  array (
    'slug' => 'pagerduty_get_current_user',
    'class' => 'PagerdutyGetCurrentUser',
    'method' => 'GET',
    'path' => '/users/me',
    'operation_id' => 'getCurrentUser',
    'name' => 'Get the current user',
    'description' => 'Get the current user Get details about the current user. This endpoint can only be used with a [user-level API key](https://support.pagerduty.com/docs/using-the-api#section-generating-a-personal-rest-api-key) or a key generated through an OAuth flow. This will not work if the request is made with an account-level access token. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users)',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_custom_fields_field' =>
  array (
    'slug' => 'pagerduty_get_custom_fields_field',
    'class' => 'PagerdutyGetCustomFieldsField',
    'method' => 'GET',
    'path' => '/incidents/custom_fields/{field_id}',
    'operation_id' => 'getCustomFieldsField',
    'name' => 'Get a Field',
    'description' => 'Get a Field <!-- theme: warning --> > ### Deprecated > This endpoint is deprecated and only works for fields on the Base Incident Type. \\ > For more flexibility, we recommend using the Incident Types endpoint: \\ > [/incidents/types/{type_id_or_name}/custom_fields/{field_id}](openapiv3.json/paths/~1incidents~1types~1{type_id_or_name}~1custom_fields~1{field_id}/get) Show detailed information about a Custom Field on the Base Incident Type. Scoped OAuth requires: `custom_fields.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_custom_shift' =>
  array (
    'slug' => 'pagerduty_get_custom_shift',
    'class' => 'PagerdutyGetCustomShift',
    'method' => 'GET',
    'path' => '/v3/schedules/{id}/custom_shifts/{custom_shift_id}',
    'operation_id' => 'getCustomShift',
    'name' => 'Get a custom shift',
    'description' => 'Get a custom shift <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Retrieve a single custom shift by ID.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_entity_type_by_id_tags' =>
  array (
    'slug' => 'pagerduty_get_entity_type_by_id_tags',
    'class' => 'PagerdutyGetEntityTypeByIdTags',
    'method' => 'GET',
    'path' => '/{entity_type}/{id}/tags',
    'operation_id' => 'getEntityTypeByIdTags',
    'name' => 'Get tags for entities',
    'description' => 'Get tags for entities Get related tags for Users, Teams or Escalation Policies. A Tag is applied to Escalation Policies, Teams or Users and can be used to filter them. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#tags) Scoped OAuth requires: `tags.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_escalation_policy' =>
  array (
    'slug' => 'pagerduty_get_escalation_policy',
    'class' => 'PagerdutyGetEscalationPolicy',
    'method' => 'GET',
    'path' => '/escalation_policies/{id}',
    'operation_id' => 'getEscalationPolicy',
    'name' => 'Get an escalation policy',
    'description' => 'Get an escalation policy Get information about an existing escalation policy and its rules. Escalation policies define which user should be alerted at which time. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#escalation-policies) Scoped OAuth requires: `escalation_policies.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_event' =>
  array (
    'slug' => 'pagerduty_get_event',
    'class' => 'PagerdutyGetEvent',
    'method' => 'GET',
    'path' => '/v3/schedules/{id}/rotations/{rotation_id}/events/{event_id}',
    'operation_id' => 'getEvent',
    'name' => 'Get an event',
    'description' => 'Get an event <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Retrieve a specific event by ID.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_extension' =>
  array (
    'slug' => 'pagerduty_get_extension',
    'class' => 'PagerdutyGetExtension',
    'method' => 'GET',
    'path' => '/extensions/{id}',
    'operation_id' => 'getExtension',
    'name' => 'Get an extension',
    'description' => 'Get an extension Get details about an existing extension. Extensions are representations of Extension Schema objects that are attached to Services. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#extensions) Scoped OAuth requires: `extensions.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_extension_schema' =>
  array (
    'slug' => 'pagerduty_get_extension_schema',
    'class' => 'PagerdutyGetExtensionSchema',
    'method' => 'GET',
    'path' => '/extension_schemas/{id}',
    'operation_id' => 'getExtensionSchema',
    'name' => 'Get an extension vendor',
    'description' => 'Get an extension vendor Get details about one specific extension vendor. A PagerDuty extension vendor represents a specific type of outbound extension such as Generic Webhook, Slack, ServiceNow. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#extension-schemas) Scoped OAuth requires: `extension_schemas.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_external_data_cache_var_data_on_global_orch' =>
  array (
    'slug' => 'pagerduty_get_external_data_cache_var_data_on_global_orch',
    'class' => 'PagerdutyGetExternalDataCacheVarDataOnGlobalOrch',
    'method' => 'GET',
    'path' => '/event_orchestrations/{id}/cache_variables/{cache_variable_id}/data',
    'operation_id' => 'getExternalDataCacheVarDataOnGlobalOrch',
    'name' => 'Get Data for an External Data Cache Variable on a Global Event Orchestration',
    'description' => 'Get Data for an External Data Cache Variable on a Global Event Orchestration Get the data for an `external_data` type Cache Variable on a Global Orchestration. Use External Data type Cache Variables to store string, number, or boolean values via a dedicated API endpoint. These stored values can then be used in conditions or actions in Event Orchestration rules. For more information see the [Knowledge Base](https://support.pagerduty.com/main/docs/event-orchestration-cache-variables) Scoped OAuth requires: `event_orchestrations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_external_data_cache_var_data_on_service_orch' =>
  array (
    'slug' => 'pagerduty_get_external_data_cache_var_data_on_service_orch',
    'class' => 'PagerdutyGetExternalDataCacheVarDataOnServiceOrch',
    'method' => 'GET',
    'path' => '/event_orchestrations/services/{service_id}/cache_variables/{cache_variable_id}/data',
    'operation_id' => 'getExternalDataCacheVarDataOnServiceOrch',
    'name' => 'Get Data for an External Data Cache Variable on a Service Event Orchestration',
    'description' => 'Get Data for an External Data Cache Variable on a Service Event Orchestration Get the data for an `external_data` type Cache Variable for a Service Event Orchestration. Use External Data type Cache Variables to store string, number, or boolean values via a dedicated API endpoint. These stored values can then be used in conditions or actions in Event Orchestration rules. For more information see the [Knowledge Base](https://support.pagerduty.com/main/docs/event-orchestration-cache-variables) Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_incident' =>
  array (
    'slug' => 'pagerduty_get_incident',
    'class' => 'PagerdutyGetIncident',
    'method' => 'GET',
    'path' => '/incidents/{id}',
    'operation_id' => 'getIncident',
    'name' => 'Get an incident',
    'description' => 'Get an incident Show detailed information about an incident. Accepts either an incident id, or an incident number. An incident represents a problem or an issue that needs to be addressed and resolved. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_incident_alert' =>
  array (
    'slug' => 'pagerduty_get_incident_alert',
    'class' => 'PagerdutyGetIncidentAlert',
    'method' => 'GET',
    'path' => '/incidents/{id}/alerts/{alert_id}',
    'operation_id' => 'getIncidentAlert',
    'name' => 'Get an alert',
    'description' => 'Get an alert Show detailed information about an alert. Accepts an alert id. An incident represents a problem or an issue that needs to be addressed and resolved. When a service sends an event to PagerDuty, an alert and corresponding incident is triggered in PagerDuty. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_incident_field_values' =>
  array (
    'slug' => 'pagerduty_get_incident_field_values',
    'class' => 'PagerdutyGetIncidentFieldValues',
    'method' => 'GET',
    'path' => '/incidents/{id}/custom_fields/values',
    'operation_id' => 'getIncidentFieldValues',
    'name' => 'Get Custom Field Values',
    'description' => 'Get Custom Field Values Get custom field values for an incident. <!-- theme: warning --> Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_incident_impacted_business_services' =>
  array (
    'slug' => 'pagerduty_get_incident_impacted_business_services',
    'class' => 'PagerdutyGetIncidentImpactedBusinessServices',
    'method' => 'GET',
    'path' => '/incidents/{id}/business_services/impacts',
    'operation_id' => 'getIncidentImpactedBusinessServices',
    'name' => 'List Business Services impacted by the given Incident',
    'description' => 'List Business Services impacted by the given Incident Retrieve a list of Business Services that are being impacted by the given Incident. Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_incident_notification_subscribers' =>
  array (
    'slug' => 'pagerduty_get_incident_notification_subscribers',
    'class' => 'PagerdutyGetIncidentNotificationSubscribers',
    'method' => 'GET',
    'path' => '/incidents/{id}/status_updates/subscribers',
    'operation_id' => 'getIncidentNotificationSubscribers',
    'name' => 'List Notification Subscribers',
    'description' => 'List Notification Subscribers Retrieve a list of Notification Subscribers on the Incident. <!-- theme: warning --> > Users must be added through `POST /incident/{id}/status_updates/subscribers` to be returned from this endpoint. Scoped OAuth requires: `subscribers.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_incident_type' =>
  array (
    'slug' => 'pagerduty_get_incident_type',
    'class' => 'PagerdutyGetIncidentType',
    'method' => 'GET',
    'path' => '/incidents/types/{type_id_or_name}',
    'operation_id' => 'getIncidentType',
    'name' => 'Get an Incident Type',
    'description' => 'Get an Incident Type Get detailed information about a single incident type. Accepts either an incident type id, or an incident type name. Incident Types are a feature which will allow customers to categorize incidents, such as a security incident, a major incident, or a fraud incident. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incident) Scoped OAuth requires: `incident_types.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_incident_type_custom_field' =>
  array (
    'slug' => 'pagerduty_get_incident_type_custom_field',
    'class' => 'PagerdutyGetIncidentTypeCustomField',
    'method' => 'GET',
    'path' => '/incidents/types/{type_id_or_name}/custom_fields/{field_id}',
    'operation_id' => 'getIncidentTypeCustomField',
    'name' => 'Get an Incident Type Custom Field',
    'description' => 'Get an Incident Type Custom Field Get a custom field for an incident type. Custom Fields (CF) are a feature which will allow customers to extend Incidents with their own custom data, to provide additional context and support features such as customized filtering, search and analytics. Custom Fields can be applied to different incident types. Scoped OAuth requires: `custom_fields.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_incident_type_custom_field_field_options' =>
  array (
    'slug' => 'pagerduty_get_incident_type_custom_field_field_options',
    'class' => 'PagerdutyGetIncidentTypeCustomFieldFieldOptions',
    'method' => 'GET',
    'path' => '/incidents/types/{type_id_or_name}/custom_fields/{field_id}/field_options/{field_option_id}',
    'operation_id' => 'getIncidentTypeCustomFieldFieldOptions',
    'name' => 'Get a Field Option on a Custom Field',
    'description' => 'Get a Field Option on a Custom Field Get a field option on a custom field Custom Fields (CF) are a feature which will allow customers to extend Incidents with their own custom data, to provide additional context and support features such as customized filtering, search and analytics. Custom Fields can be applied to different incident types. Scoped OAuth requires: `custom_fields.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_incident_workflow' =>
  array (
    'slug' => 'pagerduty_get_incident_workflow',
    'class' => 'PagerdutyGetIncidentWorkflow',
    'method' => 'GET',
    'path' => '/incident_workflows/{id}',
    'operation_id' => 'getIncidentWorkflow',
    'name' => 'Get an Incident Workflow',
    'description' => 'Get an Incident Workflow Get an existing Incident Workflow An Incident Workflow is a sequence of configurable Steps and associated Triggers that can execute automated Actions for a given Incident. Scoped OAuth requires: `incident_workflows.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_incident_workflow_action' =>
  array (
    'slug' => 'pagerduty_get_incident_workflow_action',
    'class' => 'PagerdutyGetIncidentWorkflowAction',
    'method' => 'GET',
    'path' => '/incident_workflows/actions/{id}',
    'operation_id' => 'getIncidentWorkflowAction',
    'name' => 'Get an Action',
    'description' => 'Get an Action Get an Incident Workflow Action Scoped OAuth requires: `incident_workflows.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_incident_workflow_trigger' =>
  array (
    'slug' => 'pagerduty_get_incident_workflow_trigger',
    'class' => 'PagerdutyGetIncidentWorkflowTrigger',
    'method' => 'GET',
    'path' => '/incident_workflows/triggers/{id}',
    'operation_id' => 'getIncidentWorkflowTrigger',
    'name' => 'Get a Trigger',
    'description' => 'Get a Trigger Retrieve an existing Incident Workflows Trigger Scoped OAuth requires: `incident_workflows.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_log_entry' =>
  array (
    'slug' => 'pagerduty_get_log_entry',
    'class' => 'PagerdutyGetLogEntry',
    'method' => 'GET',
    'path' => '/log_entries/{id}',
    'operation_id' => 'getLogEntry',
    'name' => 'Get a log entry',
    'description' => 'Get a log entry Get details for a specific incident log entry. This method provides additional information you can use to get at raw event data. A log of all the events that happen to an Incident, and these are exposed as Log Entries. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#log-entries) Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_maintenance_window' =>
  array (
    'slug' => 'pagerduty_get_maintenance_window',
    'class' => 'PagerdutyGetMaintenanceWindow',
    'method' => 'GET',
    'path' => '/maintenance_windows/{id}',
    'operation_id' => 'getMaintenanceWindow',
    'name' => 'Get a maintenance window',
    'description' => 'Get a maintenance window Get an existing maintenance window. A Maintenance Window is used to temporarily disable one or more Services for a set period of time. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#maintenance-windows) Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_oauth_client' =>
  array (
    'slug' => 'pagerduty_get_oauth_client',
    'class' => 'PagerdutyGetOauthClient',
    'method' => 'GET',
    'path' => '/webhook_subscriptions/oauth_clients/{id}',
    'operation_id' => 'getOauthClient',
    'name' => 'Get an OAuth client',
    'description' => 'Get an OAuth client Get details of a specific OAuth client by ID. Requires admin or owner role permissions.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_oauth_delegations_revocation_requests_status' =>
  array (
    'slug' => 'pagerduty_get_oauth_delegations_revocation_requests_status',
    'class' => 'PagerdutyGetOauthDelegationsRevocationRequestsStatus',
    'method' => 'GET',
    'path' => '/oauth_delegations/revocation_requests/status',
    'operation_id' => 'getOauthDelegationsRevocationRequestsStatus',
    'name' => 'Get OAuth delegations revocation requests status',
    'description' => 'Get OAuth delegations revocation requests status <!-- theme: warning --> > ### Deprecated > This endpoint is deprecated as OAuth token revocation is now synchronous. Please use the [DELETE /oauth_delegations endpoint](https://developer.pagerduty.com/api-reference/ad1161db75db1-delete-all-o-auth-delegations) instead. Get the status of all OAuth delegations revocation requests for this account, specifically how many requests are still pending. As all requests are now synchronous, no pending requests will be found. This endpoint is limited to account owners and admins. Scoped OAuth requires: `oauth_delegations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_orch_active_status' =>
  array (
    'slug' => 'pagerduty_get_orch_active_status',
    'class' => 'PagerdutyGetOrchActiveStatus',
    'method' => 'GET',
    'path' => '/event_orchestrations/services/{service_id}/active',
    'operation_id' => 'getOrchActiveStatus',
    'name' => 'Get the Service Orchestration active status for a Service',
    'description' => 'Get the Service Orchestration active status for a Service Get a Service Orchestration\'s active status. A Service Orchestration allows you to set an active status based on whether an event will be evaluated against a service orchestration path (true) or service ruleset (false). For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_orch_path_global' =>
  array (
    'slug' => 'pagerduty_get_orch_path_global',
    'class' => 'PagerdutyGetOrchPathGlobal',
    'method' => 'GET',
    'path' => '/event_orchestrations/{id}/global',
    'operation_id' => 'getOrchPathGlobal',
    'name' => 'Get the Global Orchestration for an Event Orchestration',
    'description' => 'Get the Global Orchestration for an Event Orchestration. Global Orchestration Rules allows you to create a set of Event Rules. These rules evaluate against all Events sent to an Event Orchestration. When a matching rule is found, it can modify and enhance the event and can route the event to another set of Global Rules within this Orchestration for further processing. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_orch_path_router' =>
  array (
    'slug' => 'pagerduty_get_orch_path_router',
    'class' => 'PagerdutyGetOrchPathRouter',
    'method' => 'GET',
    'path' => '/event_orchestrations/{id}/router',
    'operation_id' => 'getOrchPathRouter',
    'name' => 'Get the Router for an Event Orchestration',
    'description' => 'Get the Router for an Event Orchestration Get a Global Orchestration\'s Routing Rules. An Orchestration Router allows you to create a set of Event Rules. The Router evaluates Events you send to this Global Orchestration against each of its rules, one at a time, and routes the event to a specific Service based on the first rule that matches. If an event doesn\'t match any rules, it\'ll be sent to service specified in as the `catch_all` or the "Unrouted" Orchestration if no service is specified. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_orch_path_service' =>
  array (
    'slug' => 'pagerduty_get_orch_path_service',
    'class' => 'PagerdutyGetOrchPathService',
    'method' => 'GET',
    'path' => '/event_orchestrations/services/{service_id}',
    'operation_id' => 'getOrchPathService',
    'name' => 'Get the Service Orchestration for a Service',
    'description' => 'Get the Service Orchestration for a Service Get a Service Orchestration. A Service Orchestration allows you to create a set of Event Rules. The Service Orchestration evaluates Events sent to this Service against each of its rules, beginning with the rules in the "start" set. When a matching rule is found, it can modify and enhance the event and can route the event to another set of rules within this Service Orchestration for further processing. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_orch_path_unrouted' =>
  array (
    'slug' => 'pagerduty_get_orch_path_unrouted',
    'class' => 'PagerdutyGetOrchPathUnrouted',
    'method' => 'GET',
    'path' => '/event_orchestrations/{id}/unrouted',
    'operation_id' => 'getOrchPathUnrouted',
    'name' => 'Get the Unrouted Orchestration for an Event Orchestration',
    'description' => 'Get the Unrouted Orchestration for an Event Orchestration Get a Global Event Orchestration\'s Rules for Unrouted events. An Unrouted Orchestration allows you to create a set of Event Rules that will be evaluated against all events that don\'t match any rules in the Global Orchestration\'s Router. Events that reach the Unrouted Orchestration will never be routed to a specific Service. The Unrouted Orchestration evaluates Events sent to it against each of its rules, beginning with the rules in the "start" set. When a matching rule is found, it can modify and enhance the event and can route the event to another set of rules within this Unrouted Orchestration for further processing. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_orchestration' =>
  array (
    'slug' => 'pagerduty_get_orchestration',
    'class' => 'PagerdutyGetOrchestration',
    'method' => 'GET',
    'path' => '/event_orchestrations/{id}',
    'operation_id' => 'getOrchestration',
    'name' => 'Get an Orchestration',
    'description' => 'Get an Orchestration Get a Global Event Orchestration. Global Event Orchestrations allow you define a set of Global Rules and Router Rules, so that when you ingest events using the Orchestration\'s Routing Key your events will have actions applied via the Global Rules & then routed to the correct Service by the Router Rules, based on the event\'s content. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_orchestration_integration' =>
  array (
    'slug' => 'pagerduty_get_orchestration_integration',
    'class' => 'PagerdutyGetOrchestrationIntegration',
    'method' => 'GET',
    'path' => '/event_orchestrations/{id}/integrations/{integration_id}',
    'operation_id' => 'getOrchestrationIntegration',
    'name' => 'Get an Integration for an Event Orchestration',
    'description' => 'Get an Integration for an Event Orchestration Get an Integration associated with this Event Orchestrations. You can use the Routing Key from this Integration to send events to PagerDuty! For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_outlier_incident' =>
  array (
    'slug' => 'pagerduty_get_outlier_incident',
    'class' => 'PagerdutyGetOutlierIncident',
    'method' => 'GET',
    'path' => '/incidents/{id}/outlier_incident',
    'operation_id' => 'getOutlierIncident',
    'name' => 'Get Outlier Incident',
    'description' => 'Get Outlier Incident Gets Outlier Incident information for a given Incident on its Service. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#outlier-incident) Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_override' =>
  array (
    'slug' => 'pagerduty_get_override',
    'class' => 'PagerdutyGetOverride',
    'method' => 'GET',
    'path' => '/v3/schedules/{id}/overrides/{override_id}',
    'operation_id' => 'getOverride',
    'name' => 'Get an override',
    'description' => 'Get an override <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Retrieve a single override by ID.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_past_incidents' =>
  array (
    'slug' => 'pagerduty_get_past_incidents',
    'class' => 'PagerdutyGetPastIncidents',
    'method' => 'GET',
    'path' => '/incidents/{id}/past_incidents',
    'operation_id' => 'getPastIncidents',
    'name' => 'Get Past Incidents',
    'description' => 'Get Past Incidents Past Incidents returns Incidents within the past 6 months that have similar metadata and were generated on the same Service as the parent Incident. By default, 5 Past Incidents are returned. Note: This feature is currently available as part of the Event Intelligence package or Digital Operations plan only. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#past_incidents) Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_paused_incident_report_alerts' =>
  array (
    'slug' => 'pagerduty_get_paused_incident_report_alerts',
    'class' => 'PagerdutyGetPausedIncidentReportAlerts',
    'method' => 'GET',
    'path' => '/paused_incident_reports/alerts',
    'operation_id' => 'getPausedIncidentReportAlerts',
    'name' => 'Get Paused Incident Reporting on Alerts',
    'description' => 'Get Paused Incident Reporting on Alerts Returns the 5 most recent alerts that were triggered after being paused and the 5 most recent alerts that were resolved after being paused for a given reporting period (maximum 6 months lookback period). Note: This feature is currently available as part of the Event Intelligence package or Digital Operations plan only. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#paused-incident-reports) Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_paused_incident_report_counts' =>
  array (
    'slug' => 'pagerduty_get_paused_incident_report_counts',
    'class' => 'PagerdutyGetPausedIncidentReportCounts',
    'method' => 'GET',
    'path' => '/paused_incident_reports/counts',
    'operation_id' => 'getPausedIncidentReportCounts',
    'name' => 'Get Paused Incident Reporting counts',
    'description' => 'Get Paused Incident Reporting counts Returns reporting counts for paused Incident usage for a given reporting period (maximum 6 months lookback period). Note: This feature is currently available as part of the Event Intelligence package or Digital Operations plan only. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#paused-incident-reports) Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_post_update' =>
  array (
    'slug' => 'pagerduty_get_post_update',
    'class' => 'PagerdutyGetPostUpdate',
    'method' => 'GET',
    'path' => '/status_pages/{id}/posts/{post_id}/post_updates/{post_update_id}',
    'operation_id' => 'getPostUpdate',
    'name' => 'Get a Status Page Post Update',
    'description' => 'Get a Status Page Post Update Get a Post Update for a Post by Post ID and Post Update ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_postmortem' =>
  array (
    'slug' => 'pagerduty_get_postmortem',
    'class' => 'PagerdutyGetPostmortem',
    'method' => 'GET',
    'path' => '/status_pages/{id}/posts/{post_id}/postmortem',
    'operation_id' => 'getPostmortem',
    'name' => 'Get a Post Postmortem',
    'description' => 'Get a Post Postmortem Get a Postmortem for a Post by Post ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_related_incidents' =>
  array (
    'slug' => 'pagerduty_get_related_incidents',
    'class' => 'PagerdutyGetRelatedIncidents',
    'method' => 'GET',
    'path' => '/incidents/{id}/related_incidents',
    'operation_id' => 'getRelatedIncidents',
    'name' => 'Get Related Incidents',
    'description' => 'Get Related Incidents Returns the 20 most recent Related Incidents that are impacting other Responders and Services. Note: This feature is currently available as part of the Event Intelligence package or Digital Operations plan only. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#related_incidents) Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_rotation' =>
  array (
    'slug' => 'pagerduty_get_rotation',
    'class' => 'PagerdutyGetRotation',
    'method' => 'GET',
    'path' => '/v3/schedules/{id}/rotations/{rotation_id}',
    'operation_id' => 'getRotation',
    'name' => 'Get a rotation',
    'description' => 'Get a rotation <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Retrieve a rotation by ID including all its events.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_ruleset' =>
  array (
    'slug' => 'pagerduty_get_ruleset',
    'class' => 'PagerdutyGetRuleset',
    'method' => 'GET',
    'path' => '/rulesets/{id}',
    'operation_id' => 'getRuleset',
    'name' => 'Get a Ruleset',
    'description' => 'Get a Ruleset. <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Rulesets allow you to route events to an endpoint and create collections of Event Rules, which define sets of actions to take based on event content. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#rulesets) Scoped OAuth requires: `event_rules.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_ruleset_event_rule' =>
  array (
    'slug' => 'pagerduty_get_ruleset_event_rule',
    'class' => 'PagerdutyGetRulesetEventRule',
    'method' => 'GET',
    'path' => '/rulesets/{id}/rules/{rule_id}',
    'operation_id' => 'getRulesetEventRule',
    'name' => 'Get an Event Rule',
    'description' => 'Get an Event Rule. <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Rulesets allow you to route events to an endpoint and create collections of Event Rules, which define sets of actions to take based on event content. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#rulesets) Note: Create and Update on rules will accept \'description\' or \'summary\' interchangeably as an extraction action target. Get and List on rules will always return \'summary\' as the target. If you are expecting \'description\' please change your automation code to expect \'summary\' instead. Scoped OAuth requires: `event_rules.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_schedule' =>
  array (
    'slug' => 'pagerduty_get_schedule',
    'class' => 'PagerdutyGetSchedule',
    'method' => 'GET',
    'path' => '/schedules/{id}',
    'operation_id' => 'getSchedule',
    'name' => 'Get a schedule',
    'description' => 'Get a schedule Show detailed information about a schedule, including entries for each layer. Scoped OAuth requires: `schedules.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_schedule_v3' =>
  array (
    'slug' => 'pagerduty_get_schedule_v3',
    'class' => 'PagerdutyGetScheduleV3',
    'method' => 'GET',
    'path' => '/v3/schedules/{id}',
    'operation_id' => 'getScheduleV3',
    'name' => 'Get a schedule',
    'description' => 'Get a schedule <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Retrieve a schedule by ID including rotations and events. Optionally include the computed final schedule for a time range. Use `include[]=final_schedule` to get computed on-call assignments. Use `since` and `until` to specify the time range.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_service' =>
  array (
    'slug' => 'pagerduty_get_service',
    'class' => 'PagerdutyGetService',
    'method' => 'GET',
    'path' => '/services/{id}',
    'operation_id' => 'getService',
    'name' => 'Get a service',
    'description' => 'Get a service Get details about an existing service. A service may represent an application, component, or team you wish to open incidents against. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#services) Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_service_custom_field' =>
  array (
    'slug' => 'pagerduty_get_service_custom_field',
    'class' => 'PagerdutyGetServiceCustomField',
    'method' => 'GET',
    'path' => '/services/custom_fields/{field_id}',
    'operation_id' => 'getServiceCustomField',
    'name' => 'Get a Field',
    'description' => 'Get a Field Show detailed information about a Custom Field for Services. Scoped OAuth requires: `custom_fields.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_service_custom_field_option' =>
  array (
    'slug' => 'pagerduty_get_service_custom_field_option',
    'class' => 'PagerdutyGetServiceCustomFieldOption',
    'method' => 'GET',
    'path' => '/services/custom_fields/{field_id}/field_options/{field_option_id}',
    'operation_id' => 'getServiceCustomFieldOption',
    'name' => 'Get a Field Option',
    'description' => 'Get a Field Option Get a field option for a given field. Scoped OAuth requires: `custom_fields.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_service_custom_field_values' =>
  array (
    'slug' => 'pagerduty_get_service_custom_field_values',
    'class' => 'PagerdutyGetServiceCustomFieldValues',
    'method' => 'GET',
    'path' => '/services/{id}/custom_fields/values',
    'operation_id' => 'getServiceCustomFieldValues',
    'name' => 'Get Custom Field Values',
    'description' => 'Get Custom Field Values Get custom field values for a service. Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_service_event_rule' =>
  array (
    'slug' => 'pagerduty_get_service_event_rule',
    'class' => 'PagerdutyGetServiceEventRule',
    'method' => 'GET',
    'path' => '/services/{id}/rules/{rule_id}',
    'operation_id' => 'getServiceEventRule',
    'name' => 'Get an Event Rule from a Service',
    'description' => 'Get an Event Rule from a Service. <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_service_integration' =>
  array (
    'slug' => 'pagerduty_get_service_integration',
    'class' => 'PagerdutyGetServiceIntegration',
    'method' => 'GET',
    'path' => '/services/{id}/integrations/{integration_id}',
    'operation_id' => 'getServiceIntegration',
    'name' => 'View an integration',
    'description' => 'View an integration Get details about an integration belonging to a service. A service may represent an application, component, or team you wish to open incidents against. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#services) Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_session_configurations' =>
  array (
    'slug' => 'pagerduty_get_session_configurations',
    'class' => 'PagerdutyGetSessionConfigurations',
    'method' => 'GET',
    'path' => '/session_configurations',
    'operation_id' => 'getSessionConfigurations',
    'name' => 'Get an account\'s session configurations',
    'description' => 'Get an account\'s session configurations Retrieves session configurations for a PagerDuty account. Returns an array containing the requested configurations. If a specific type is requested, the array contains one item. If no type is specified, the array contains all available configurations (mobile and web). If no configurations exist, a 404 Not Found error will be returned. A Session Configuration needs to be created before it can be retrieved and used. Scoped OAuth requires: `session_configurations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_status_dashboard_by_id' =>
  array (
    'slug' => 'pagerduty_get_status_dashboard_by_id',
    'class' => 'PagerdutyGetStatusDashboardById',
    'method' => 'GET',
    'path' => '/status_dashboards/{id}',
    'operation_id' => 'getStatusDashboardById',
    'name' => 'Get a single Status Dashboard by `id`',
    'description' => 'Get a single Status Dashboard by `id` Get a Status Dashboard by its PagerDuty `id`. Scoped OAuth requires: `status_dashboards.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_status_dashboard_by_url_slug' =>
  array (
    'slug' => 'pagerduty_get_status_dashboard_by_url_slug',
    'class' => 'PagerdutyGetStatusDashboardByUrlSlug',
    'method' => 'GET',
    'path' => '/status_dashboards/url_slugs/{url_slug}',
    'operation_id' => 'getStatusDashboardByUrlSlug',
    'name' => 'Get a single Status Dashboard by `url_slug`',
    'description' => 'Get a single Status Dashboard by `url_slug` Get a Status Dashboard by its PagerDuty `url_slug`. A `url_slug` is a human-readable reference for a custom Status Dashboard that may be created or changed in the UI. It will generally be a `dash-separated-string-like-this`. Scoped OAuth requires: `status_dashboards.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_status_dashboard_service_impacts_by_id' =>
  array (
    'slug' => 'pagerduty_get_status_dashboard_service_impacts_by_id',
    'class' => 'PagerdutyGetStatusDashboardServiceImpactsById',
    'method' => 'GET',
    'path' => '/status_dashboards/{id}/service_impacts',
    'operation_id' => 'getStatusDashboardServiceImpactsById',
    'name' => 'Get impacted Business Services for a Status Dashboard by `id`.',
    'description' => 'Get impacted Business Services for a Status Dashboard by `id`. Get impacted Business Services for a Status Dashboard by `id` This endpoint does not return an exhaustive list of Business Services but rather provides access to the most impacted on the specified Status Dashboard up to the limit of 200. The returned Business Services are sorted first by Impact, secondarily by most recently impacted, and finally by name. To get Impact information about a specific Business Service on the Status Dashboard that does not appear in the Impact-sorted response, use the `ids[]` parameter on the `/business_services/impacts` endpoint. Scoped OAuth requires: `status_dashboards.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_status_dashboard_service_impacts_by_url_slug' =>
  array (
    'slug' => 'pagerduty_get_status_dashboard_service_impacts_by_url_slug',
    'class' => 'PagerdutyGetStatusDashboardServiceImpactsByUrlSlug',
    'method' => 'GET',
    'path' => '/status_dashboards/url_slugs/{url_slug}/service_impacts',
    'operation_id' => 'getStatusDashboardServiceImpactsByUrlSlug',
    'name' => 'Get impacted Business Services for a Status Dashboard by `url_slug`',
    'description' => 'Get impacted Business Services for a Status Dashboard by `url_slug` Get Business Service Impacts for the Business Services on a Status Dashboard by its `url_slug`. A `url_slug` is a human-readable reference for a custom Status Dashboard that may be created or changed in the UI. It will generally be a `dash-separated-string-like-this`. This endpoint does not return an exhaustive list of Business Services but rather provides access to the most impacted on the Status Dashboard up to the limit of 200. The returned Business Services are sorted first by Impact, secondarily by most recently impacted, and finally by name. To get impact information about a specific Business Service on the Status Dashboard that does not appear in the Impact-sored response, use the `ids[]` parameter on the `/business_services/impacts` endpoint. Scoped OAuth requires: `status_dashboards.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_status_page_impact' =>
  array (
    'slug' => 'pagerduty_get_status_page_impact',
    'class' => 'PagerdutyGetStatusPageImpact',
    'method' => 'GET',
    'path' => '/status_pages/{id}/impacts/{impact_id}',
    'operation_id' => 'getStatusPageImpact',
    'name' => 'Get a Status Page Impact',
    'description' => 'Get a Status Page Impact Get an Impact for a Status Page by Status Page ID and Impact ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_status_page_post' =>
  array (
    'slug' => 'pagerduty_get_status_page_post',
    'class' => 'PagerdutyGetStatusPagePost',
    'method' => 'GET',
    'path' => '/status_pages/{id}/posts/{post_id}',
    'operation_id' => 'getStatusPagePost',
    'name' => 'Get a Status Page Post',
    'description' => 'Get a Status Page Post Get a Post for a Status Page by Status Page ID and Post ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_status_page_service' =>
  array (
    'slug' => 'pagerduty_get_status_page_service',
    'class' => 'PagerdutyGetStatusPageService',
    'method' => 'GET',
    'path' => '/status_pages/{id}/services/{service_id}',
    'operation_id' => 'getStatusPageService',
    'name' => 'Get a Status Page Service',
    'description' => 'Get a Status Page Service Get a Service for a Status Page by Status Page ID and Service ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_status_page_severity' =>
  array (
    'slug' => 'pagerduty_get_status_page_severity',
    'class' => 'PagerdutyGetStatusPageSeverity',
    'method' => 'GET',
    'path' => '/status_pages/{id}/severities/{severity_id}',
    'operation_id' => 'getStatusPageSeverity',
    'name' => 'Get a Status Page Severity',
    'description' => 'Get a Status Page Severity Get a Severity for a Status Page by Status Page ID and Severity ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_status_page_status' =>
  array (
    'slug' => 'pagerduty_get_status_page_status',
    'class' => 'PagerdutyGetStatusPageStatus',
    'method' => 'GET',
    'path' => '/status_pages/{id}/statuses/{status_id}',
    'operation_id' => 'getStatusPageStatus',
    'name' => 'Get a Status Page Status',
    'description' => 'Get a Status Page Status Get a Status for a Status Page by Status Page ID and Status ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_status_page_subscription' =>
  array (
    'slug' => 'pagerduty_get_status_page_subscription',
    'class' => 'PagerdutyGetStatusPageSubscription',
    'method' => 'GET',
    'path' => '/status_pages/{id}/subscriptions/{subscription_id}',
    'operation_id' => 'getStatusPageSubscription',
    'name' => 'Get a Status Page Subscription',
    'description' => 'Get a Status Page Subscription Get a Subscription for a Status Page by Status Page ID and Subscription ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_tag' =>
  array (
    'slug' => 'pagerduty_get_tag',
    'class' => 'PagerdutyGetTag',
    'method' => 'GET',
    'path' => '/tags/{id}',
    'operation_id' => 'getTag',
    'name' => 'Get a tag',
    'description' => 'Get a tag Get details about an existing Tag. A Tag is applied to Escalation Policies, Teams or Users and can be used to filter them. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#tags) Scoped OAuth requires: `tags.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_tags_by_entity_type' =>
  array (
    'slug' => 'pagerduty_get_tags_by_entity_type',
    'class' => 'PagerdutyGetTagsByEntityType',
    'method' => 'GET',
    'path' => '/tags/{id}/{entity_type}',
    'operation_id' => 'getTagsByEntityType',
    'name' => 'Get connected entities',
    'description' => 'Get connected entities Get related Users, Teams or Escalation Policies for the Tag. A Tag is applied to Escalation Policies, Teams or Users and can be used to filter them. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#tags) Scoped OAuth requires: `tags.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_team' =>
  array (
    'slug' => 'pagerduty_get_team',
    'class' => 'PagerdutyGetTeam',
    'method' => 'GET',
    'path' => '/teams/{id}',
    'operation_id' => 'getTeam',
    'name' => 'Get a team',
    'description' => 'Get a team Get details about an existing team. A team is a collection of Users and Escalation Policies that represent a group of people within an organization. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#teams) Scoped OAuth requires: `teams.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_team_notification_subscriptions' =>
  array (
    'slug' => 'pagerduty_get_team_notification_subscriptions',
    'class' => 'PagerdutyGetTeamNotificationSubscriptions',
    'method' => 'GET',
    'path' => '/teams/{id}/notification_subscriptions',
    'operation_id' => 'getTeamNotificationSubscriptions',
    'name' => 'List Team Notification Subscriptions',
    'description' => 'List Team Notification Subscriptions Retrieve a list of Notification Subscriptions the given Team has. <!-- theme: warning --> > Teams must be added through `POST /teams/{id}/notification_subscriptions` to be returned from this endpoint. Scoped OAuth requires: `subscribers.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_technical_service_service_dependencies' =>
  array (
    'slug' => 'pagerduty_get_technical_service_service_dependencies',
    'class' => 'PagerdutyGetTechnicalServiceServiceDependencies',
    'method' => 'GET',
    'path' => '/service_dependencies/technical_services/{id}',
    'operation_id' => 'getTechnicalServiceServiceDependencies',
    'name' => 'Get technical service dependencies',
    'description' => 'Get technical service dependencies Get all immediate dependencies of any technical service. Technical services are also known as `services`. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#services) Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_template' =>
  array (
    'slug' => 'pagerduty_get_template',
    'class' => 'PagerdutyGetTemplate',
    'method' => 'GET',
    'path' => '/templates/{id}',
    'operation_id' => 'getTemplate',
    'name' => 'Get a template',
    'description' => 'Get a template Get a single template on the account Scoped OAuth requires: `templates.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_template_fields' =>
  array (
    'slug' => 'pagerduty_get_template_fields',
    'class' => 'PagerdutyGetTemplateFields',
    'method' => 'GET',
    'path' => '/templates/fields',
    'operation_id' => 'getTemplateFields',
    'name' => 'List template fields',
    'description' => 'List template fields Get a list of fields that can be used on the account templates. Scoped OAuth requires: `templates.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_templates' =>
  array (
    'slug' => 'pagerduty_get_templates',
    'class' => 'PagerdutyGetTemplates',
    'method' => 'GET',
    'path' => '/templates',
    'operation_id' => 'getTemplates',
    'name' => 'List templates',
    'description' => 'List templates Get a list of all the template on an account Scoped OAuth requires: `templates.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_user' =>
  array (
    'slug' => 'pagerduty_get_user',
    'class' => 'PagerdutyGetUser',
    'method' => 'GET',
    'path' => '/users/{id}',
    'operation_id' => 'getUser',
    'name' => 'Get a user',
    'description' => 'Get a user Get details about an existing user. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_user_contact_method' =>
  array (
    'slug' => 'pagerduty_get_user_contact_method',
    'class' => 'PagerdutyGetUserContactMethod',
    'method' => 'GET',
    'path' => '/users/{id}/contact_methods/{contact_method_id}',
    'operation_id' => 'getUserContactMethod',
    'name' => 'Get a user\'s contact method',
    'description' => 'Get a user\'s contact method Get details about a User\'s contact method. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users:contact_methods.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_user_contact_methods' =>
  array (
    'slug' => 'pagerduty_get_user_contact_methods',
    'class' => 'PagerdutyGetUserContactMethods',
    'method' => 'GET',
    'path' => '/users/{id}/contact_methods',
    'operation_id' => 'getUserContactMethods',
    'name' => 'List a user\'s contact methods',
    'description' => 'List a user\'s contact methods List contact methods of your PagerDuty user. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users:contact_methods.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_user_delegation' =>
  array (
    'slug' => 'pagerduty_get_user_delegation',
    'class' => 'PagerdutyGetUserDelegation',
    'method' => 'GET',
    'path' => '/users/{id}/oauth_delegations/{delegation_id}',
    'operation_id' => 'getUserDelegation',
    'name' => 'Get a user\'s delegation',
    'description' => 'Get a user\'s delegation Get details about a specific OAuth delegation. This endpoint replaces the deprecated `/users/{id}/sessions/{session_id}` endpoint. **Required OAuth Scope:** For Scoped OAuth requests, this operation requires the `oauth_delegations.read` scope. Scoped OAuth requires: `oauth_delegations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_user_handoff_notifiaction_rule' =>
  array (
    'slug' => 'pagerduty_get_user_handoff_notifiaction_rule',
    'class' => 'PagerdutyGetUserHandoffNotifiactionRule',
    'method' => 'GET',
    'path' => '/users/{id}/oncall_handoff_notification_rules/{oncall_handoff_notification_rule_id}',
    'operation_id' => 'getUserHandoffNotifiactionRule',
    'name' => 'Get a user\'s handoff notification rule',
    'description' => 'Get a user\'s handoff notification rule Get details about a User\'s Handoff Notification Rule. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_user_handoff_notification_rules' =>
  array (
    'slug' => 'pagerduty_get_user_handoff_notification_rules',
    'class' => 'PagerdutyGetUserHandoffNotificationRules',
    'method' => 'GET',
    'path' => '/users/{id}/oncall_handoff_notification_rules',
    'operation_id' => 'getUserHandoffNotificationRules',
    'name' => 'List a User\'s Handoff Notification Rules',
    'description' => 'List a User\'s Handoff Notification Rules List Handoff Notification Rules of your PagerDuty User. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_user_license' =>
  array (
    'slug' => 'pagerduty_get_user_license',
    'class' => 'PagerdutyGetUserLicense',
    'method' => 'GET',
    'path' => '/users/{id}/license',
    'operation_id' => 'getUserLicense',
    'name' => 'Get the License allocated to a User',
    'description' => 'Get the License allocated to a User Scoped OAuth requires: `licenses.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_user_notification_rule' =>
  array (
    'slug' => 'pagerduty_get_user_notification_rule',
    'class' => 'PagerdutyGetUserNotificationRule',
    'method' => 'GET',
    'path' => '/users/{id}/notification_rules/{notification_rule_id}',
    'operation_id' => 'getUserNotificationRule',
    'name' => 'Get a user\'s notification rule',
    'description' => 'Get a user\'s notification rule Get details about a user\'s notification rule. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users:contact_methods.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_user_notification_rules' =>
  array (
    'slug' => 'pagerduty_get_user_notification_rules',
    'class' => 'PagerdutyGetUserNotificationRules',
    'method' => 'GET',
    'path' => '/users/{id}/notification_rules',
    'operation_id' => 'getUserNotificationRules',
    'name' => 'List a user\'s notification rules',
    'description' => 'List a user\'s notification rules List notification rules of your PagerDuty user. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users:contact_methods.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_user_notification_subscriptions' =>
  array (
    'slug' => 'pagerduty_get_user_notification_subscriptions',
    'class' => 'PagerdutyGetUserNotificationSubscriptions',
    'method' => 'GET',
    'path' => '/users/{id}/notification_subscriptions',
    'operation_id' => 'getUserNotificationSubscriptions',
    'name' => 'List Notification Subscriptions',
    'description' => 'List Notification Subscriptions Retrieve a list of Notification Subscriptions the given User has. <!-- theme: warning --> > Users must be added through `POST /users/{id}/notification_subscriptions` to be returned from this endpoint. Scoped OAuth requires: `subscribers.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_user_session' =>
  array (
    'slug' => 'pagerduty_get_user_session',
    'class' => 'PagerdutyGetUserSession',
    'method' => 'GET',
    'path' => '/users/{id}/sessions/{type}/{session_id}',
    'operation_id' => 'getUserSession',
    'name' => 'Get a user\'s session',
    'description' => 'Get a user\'s session <!-- theme: warning --> > ### Deprecated > This endpoint is deprecated, please use the [Get OAuth Delegation endpoint](https://developer.pagerduty.com/api-reference//e3c7cd550aa2b-get-a-user-oauth-delegation) instead. Get details about a user\'s session. Beginning November 2021, user sessions no longer includes newly issued OAuth tokens. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users:sessions.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_user_sessions' =>
  array (
    'slug' => 'pagerduty_get_user_sessions',
    'class' => 'PagerdutyGetUserSessions',
    'method' => 'GET',
    'path' => '/users/{id}/sessions',
    'operation_id' => 'getUserSessions',
    'name' => 'List a user\'s active sessions',
    'description' => 'List a user\'s active sessions <!-- theme: warning --> > ### Deprecated > This endpoint is deprecated, please use the [List OAuth Delegations endpoint](https://developer.pagerduty.com/api-reference/fc03ba9dffd1f-list-user-oauth-delegations) instead. List active sessions of a PagerDuty user. Beginning November 2021, active sessions no longer includes newly issued OAuth tokens. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users:sessions.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_user_status_update_notification_rule' =>
  array (
    'slug' => 'pagerduty_get_user_status_update_notification_rule',
    'class' => 'PagerdutyGetUserStatusUpdateNotificationRule',
    'method' => 'GET',
    'path' => '/users/{id}/status_update_notification_rules/{status_update_notification_rule_id}',
    'operation_id' => 'getUserStatusUpdateNotificationRule',
    'name' => 'Get a user\'s status update notification rule',
    'description' => 'Get a user\'s status update notification rule Get details about a user\'s status update notification rule. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_user_status_update_notification_rules' =>
  array (
    'slug' => 'pagerduty_get_user_status_update_notification_rules',
    'class' => 'PagerdutyGetUserStatusUpdateNotificationRules',
    'method' => 'GET',
    'path' => '/users/{id}/status_update_notification_rules',
    'operation_id' => 'getUserStatusUpdateNotificationRules',
    'name' => 'List a user\'s status update notification rules',
    'description' => 'List a user\'s status update notification rules List status update notification rules of your PagerDuty user. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_vendor' =>
  array (
    'slug' => 'pagerduty_get_vendor',
    'class' => 'PagerdutyGetVendor',
    'method' => 'GET',
    'path' => '/vendors/{id}',
    'operation_id' => 'getVendor',
    'name' => 'Get a vendor',
    'description' => 'Get a vendor Get details about one specific vendor. A PagerDuty Vendor represents a specific type of integration. AWS Cloudwatch, Splunk, Datadog are all examples of vendors For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#vendors) Scoped OAuth requires: `vendors.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_webhook_subscription' =>
  array (
    'slug' => 'pagerduty_get_webhook_subscription',
    'class' => 'PagerdutyGetWebhookSubscription',
    'method' => 'GET',
    'path' => '/webhook_subscriptions/{id}',
    'operation_id' => 'getWebhookSubscription',
    'name' => 'Get a webhook subscription',
    'description' => 'Get a webhook subscription Gets details about an existing webhook subscription. Scoped OAuth requires: `webhook_subscriptions.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_workflow_integration' =>
  array (
    'slug' => 'pagerduty_get_workflow_integration',
    'class' => 'PagerdutyGetWorkflowIntegration',
    'method' => 'GET',
    'path' => '/workflows/integrations/{id}',
    'operation_id' => 'getWorkflowIntegration',
    'name' => 'Get Workflow Integration',
    'description' => 'Get Workflow Integration Get details about a Workflow Integration. Scoped OAuth requires: `workflow_integrations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_get_workflow_integration_connection' =>
  array (
    'slug' => 'pagerduty_get_workflow_integration_connection',
    'class' => 'PagerdutyGetWorkflowIntegrationConnection',
    'method' => 'GET',
    'path' => '/workflows/integrations/{integration_id}/connections/{id}',
    'operation_id' => 'getWorkflowIntegrationConnection',
    'name' => 'Get Workflow Integration Connection',
    'description' => 'Get Workflow Integration Connection Get details about a Workflow Integration Connection. Scoped OAuth requires: `workflow_integrations:connections.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_abilities' =>
  array (
    'slug' => 'pagerduty_list_abilities',
    'class' => 'PagerdutyListAbilities',
    'method' => 'GET',
    'path' => '/abilities',
    'operation_id' => 'listAbilities',
    'name' => 'List abilities',
    'description' => 'List abilities List all of your account\'s abilities, by name. "Abilities" describes your account\'s capabilities by feature name. For example `"teams"`. An ability may be available to your account based on things like your pricing plan or account state. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#abilities) Scoped OAuth requires: `abilities.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_addon' =>
  array (
    'slug' => 'pagerduty_list_addon',
    'class' => 'PagerdutyListAddon',
    'method' => 'GET',
    'path' => '/addons',
    'operation_id' => 'listAddon',
    'name' => 'List installed Add-ons',
    'description' => 'List installed Add-ons List all of the Add-ons installed on your account. Addon\'s are pieces of functionality that developers can write to insert new functionality into PagerDuty\'s UI. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#add-ons) Scoped OAuth requires: `addons.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_alert_grouping_settings' =>
  array (
    'slug' => 'pagerduty_list_alert_grouping_settings',
    'class' => 'PagerdutyListAlertGroupingSettings',
    'method' => 'GET',
    'path' => '/alert_grouping_settings',
    'operation_id' => 'listAlertGroupingSettings',
    'name' => 'List alert grouping settings',
    'description' => 'List alert grouping settings List all of your alert grouping settings including both single service settings and global content based settings. The settings part of Alert Grouper service allows us to create Alert Grouping Settings and configs that are required to be used during grouping of the alerts. Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_audit_records' =>
  array (
    'slug' => 'pagerduty_list_audit_records',
    'class' => 'PagerdutyListAuditRecords',
    'method' => 'GET',
    'path' => '/audit/records',
    'operation_id' => 'listAuditRecords',
    'name' => 'List audit records',
    'description' => 'List audit records List audit trail records matching provided query params or default criteria. The returned records are sorted by the `execution_time` from newest to oldest. See [`Cursor-based pagination`](https://developer.pagerduty.com/docs/rest-api-v2/pagination/) for instructions on how to paginate through the result set. Only admins, account owners, or global API tokens on PagerDuty account [pricing plans](https://www.pagerduty.com/pricing) with the "Audit Trail" feature can access this endpoint. For other role based access to audit records by resource ID, see the resource\'s API documentation. For more information see the [Audit API Document](https://developer.pagerduty.com/docs/rest-api-v2/audit-records-api/). Scoped OAuth requires: `audit_records.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_automation_action_invocations' =>
  array (
    'slug' => 'pagerduty_list_automation_action_invocations',
    'class' => 'PagerdutyListAutomationActionInvocations',
    'method' => 'GET',
    'path' => '/automation_actions/invocations',
    'operation_id' => 'listAutomationActionInvocations',
    'name' => 'List Invocations',
    'description' => 'List Invocations',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_business_services' =>
  array (
    'slug' => 'pagerduty_list_business_services',
    'class' => 'PagerdutyListBusinessServices',
    'method' => 'GET',
    'path' => '/business_services',
    'operation_id' => 'listBusinessServices',
    'name' => 'List Business Services',
    'description' => 'List Business Services List existing Business Services. Business services model capabilities that span multiple technical services and that may be owned by several different teams. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#business-services) Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_cache_var_on_global_orch' =>
  array (
    'slug' => 'pagerduty_list_cache_var_on_global_orch',
    'class' => 'PagerdutyListCacheVarOnGlobalOrch',
    'method' => 'GET',
    'path' => '/event_orchestrations/{id}/cache_variables',
    'operation_id' => 'listCacheVarOnGlobalOrch',
    'name' => 'List Cache Variables for a Global Event Orchestration',
    'description' => 'List Cache Variables for a Global Event Orchestration. Cache Variables allow you to store event data on an Event Orchestration, which can then be used in Event Orchestration rules as part of conditions or actions. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_cache_var_on_service_orch' =>
  array (
    'slug' => 'pagerduty_list_cache_var_on_service_orch',
    'class' => 'PagerdutyListCacheVarOnServiceOrch',
    'method' => 'GET',
    'path' => '/event_orchestrations/services/{service_id}/cache_variables',
    'operation_id' => 'listCacheVarOnServiceOrch',
    'name' => 'List Cache Variables for a Service Event Orchestration',
    'description' => 'List Cache Variables for a Service Event Orchestration. Cache Variables allow you to store event data on an Event Orchestration, which can then be used in Event Orchestration rules as part of conditions or actions. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_change_events' =>
  array (
    'slug' => 'pagerduty_list_change_events',
    'class' => 'PagerdutyListChangeEvents',
    'method' => 'GET',
    'path' => '/change_events',
    'operation_id' => 'listChangeEvents',
    'name' => 'List Change Events',
    'description' => 'List Change Events List all of the existing Change Events. Scoped OAuth requires: `change_events.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_custom_fields_field_options' =>
  array (
    'slug' => 'pagerduty_list_custom_fields_field_options',
    'class' => 'PagerdutyListCustomFieldsFieldOptions',
    'method' => 'GET',
    'path' => '/incidents/custom_fields/{field_id}/field_options',
    'operation_id' => 'listCustomFieldsFieldOptions',
    'name' => 'List Field Options',
    'description' => 'List Field Options <!-- theme: warning --> > ### Deprecated > This endpoint is deprecated and only works for fields on the Base Incident Type. \\ > For more flexibility, we recommend using the Incident Types endpoint: \\ > [/incidents/types/{type_id_or_name}/custom_fields/{field_id}/field_options](openapiv3.json/paths/~1incidents~1types~1{type_id_or_name}~1custom_fields~1{field_id}~1field_options/get) List all enabled Field Options for a Custom Field on the Base Incident Type. Scoped OAuth requires: `custom_fields.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_custom_fields_fields' =>
  array (
    'slug' => 'pagerduty_list_custom_fields_fields',
    'class' => 'PagerdutyListCustomFieldsFields',
    'method' => 'GET',
    'path' => '/incidents/custom_fields',
    'operation_id' => 'listCustomFieldsFields',
    'name' => 'List Fields',
    'description' => 'List Fields <!-- theme: warning --> > ### Deprecated > This endpoint is deprecated and only works for fields on the Base Incident Type. \\ > For more flexibility, we recommend using the Incident Types endpoint: \\ > [/incidents/types/{type_id_or_name}/custom_fields](openapiv3.json/paths/~1incidents~1types~1{type_id_or_name}~1custom_fields/get) List Custom Fields on the Base Incident Type. Scoped OAuth requires: `custom_fields.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_custom_shifts' =>
  array (
    'slug' => 'pagerduty_list_custom_shifts',
    'class' => 'PagerdutyListCustomShifts',
    'method' => 'GET',
    'path' => '/v3/schedules/{id}/custom_shifts',
    'operation_id' => 'listCustomShifts',
    'name' => 'List custom shifts',
    'description' => 'List custom shifts <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Retrieve custom shifts for a schedule within a time range. **`since` and `until` are required.**',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_escalation_policies' =>
  array (
    'slug' => 'pagerduty_list_escalation_policies',
    'class' => 'PagerdutyListEscalationPolicies',
    'method' => 'GET',
    'path' => '/escalation_policies',
    'operation_id' => 'listEscalationPolicies',
    'name' => 'List escalation policies',
    'description' => 'List escalation policies List all of the existing escalation policies. Escalation policies define which user should be alerted at which time. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#escalation-policies) Scoped OAuth requires: `escalation_policies.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_escalation_policy_audit_records' =>
  array (
    'slug' => 'pagerduty_list_escalation_policy_audit_records',
    'class' => 'PagerdutyListEscalationPolicyAuditRecords',
    'method' => 'GET',
    'path' => '/escalation_policies/{id}/audit/records',
    'operation_id' => 'listEscalationPolicyAuditRecords',
    'name' => 'List audit records for an escalation policy',
    'description' => 'List audit records for an escalation policy The returned records are sorted by the `execution_time` from newest to oldest. See [`Cursor-based pagination`](https://developer.pagerduty.com/docs/rest-api-v2/pagination/) for instructions on how to paginate through the result set. For more information see the [Audit API Document](https://developer.pagerduty.com/docs/rest-api-v2/audit-records-api/). Scoped OAuth requires: `audit_records.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_event_orchestration_feature_enablements' =>
  array (
    'slug' => 'pagerduty_list_event_orchestration_feature_enablements',
    'class' => 'PagerdutyListEventOrchestrationFeatureEnablements',
    'method' => 'GET',
    'path' => '/event_orchestrations/{id}/enablements',
    'operation_id' => 'listEventOrchestrationFeatureEnablements',
    'name' => 'List Enablements for an Event Orchestration',
    'description' => 'List Enablements for an Event Orchestration List all feature enablement settings for an Event Orchestration. Currently, only the `aiops` enablement is supported. For any account with the AIOps product addon, every Event Orchestration will have AIOps features enabled by default. **Warning conditions**: - If the account is not entitled to use AIOps features, a warning will be returned alongside the enablement data. Scoped OAuth requires: `event_orchestrations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_event_orchestrations' =>
  array (
    'slug' => 'pagerduty_list_event_orchestrations',
    'class' => 'PagerdutyListEventOrchestrations',
    'method' => 'GET',
    'path' => '/event_orchestrations',
    'operation_id' => 'listEventOrchestrations',
    'name' => 'List Event Orchestrations',
    'description' => 'List Event Orchestrations List all Global Event Orchestrations on an Account. Global Event Orchestrations allow you define a set of Global Rules and Router Rules, so that when you ingest events using the Orchestration\'s Routing Key your events will have actions applied via the Global Rules & then routed to the correct Service by the Router Rules, based on the event\'s content. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_events' =>
  array (
    'slug' => 'pagerduty_list_events',
    'class' => 'PagerdutyListEvents',
    'method' => 'GET',
    'path' => '/v3/schedules/{id}/rotations/{rotation_id}/events',
    'operation_id' => 'listEvents',
    'name' => 'List events',
    'description' => 'List events <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Retrieve all events for a rotation, ordered by start time.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_extension_schemas' =>
  array (
    'slug' => 'pagerduty_list_extension_schemas',
    'class' => 'PagerdutyListExtensionSchemas',
    'method' => 'GET',
    'path' => '/extension_schemas',
    'operation_id' => 'listExtensionSchemas',
    'name' => 'List extension schemas',
    'description' => 'List extension schemas List all extension schemas. A PagerDuty extension vendor represents a specific type of outbound extension such as Generic Webhook, Slack, ServiceNow. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#extension-schemas) Scoped OAuth requires: `extension_schemas.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_extensions' =>
  array (
    'slug' => 'pagerduty_list_extensions',
    'class' => 'PagerdutyListExtensions',
    'method' => 'GET',
    'path' => '/extensions',
    'operation_id' => 'listExtensions',
    'name' => 'List extensions',
    'description' => 'List extensions List existing extensions. Extensions are representations of Extension Schema objects that are attached to Services. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#extensions) Scoped OAuth requires: `extensions.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_incident_alerts' =>
  array (
    'slug' => 'pagerduty_list_incident_alerts',
    'class' => 'PagerdutyListIncidentAlerts',
    'method' => 'GET',
    'path' => '/incidents/{id}/alerts',
    'operation_id' => 'listIncidentAlerts',
    'name' => 'List alerts for an incident',
    'description' => 'List alerts for an incident List alerts for the specified incident. An incident represents a problem or an issue that needs to be addressed and resolved. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_incident_log_entries' =>
  array (
    'slug' => 'pagerduty_list_incident_log_entries',
    'class' => 'PagerdutyListIncidentLogEntries',
    'method' => 'GET',
    'path' => '/incidents/{id}/log_entries',
    'operation_id' => 'listIncidentLogEntries',
    'name' => 'List log entries for an incident',
    'description' => 'List log entries for an incident List log entries for the specified incident. An incident represents a problem or an issue that needs to be addressed and resolved. A Log Entry are a record of all events on your account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_incident_notes' =>
  array (
    'slug' => 'pagerduty_list_incident_notes',
    'class' => 'PagerdutyListIncidentNotes',
    'method' => 'GET',
    'path' => '/incidents/{id}/notes',
    'operation_id' => 'listIncidentNotes',
    'name' => 'List notes for an incident',
    'description' => 'List notes for an incident List existing notes for the specified incident. An incident represents a problem or an issue that needs to be addressed and resolved. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_incident_related_change_events' =>
  array (
    'slug' => 'pagerduty_list_incident_related_change_events',
    'class' => 'PagerdutyListIncidentRelatedChangeEvents',
    'method' => 'GET',
    'path' => '/incidents/{id}/related_change_events',
    'operation_id' => 'listIncidentRelatedChangeEvents',
    'name' => 'List related Change Events for an Incident',
    'description' => 'List related Change Events for an Incident, as well as the reason these changes are correlated with the incident. Change events represent service changes such as deploys, build completion, and configuration changes, providing information that is critical during incident triage or hypercare. For more information on change events, see [Change Events](https://support.pagerduty.com/docs/change-events). The Change Correlation feature provides incident responders with recent change events that are most relevant to that incident. Change Correlation informs the responder why a particular change event was surfaced and correlated to an incident based on three key factors which include time, related service, or intelligence (machine learning). Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_incident_type_custom_field' =>
  array (
    'slug' => 'pagerduty_list_incident_type_custom_field',
    'class' => 'PagerdutyListIncidentTypeCustomField',
    'method' => 'GET',
    'path' => '/incidents/types/{type_id_or_name}/custom_fields/{field_id}/field_options',
    'operation_id' => 'listIncidentTypeCustomField',
    'name' => 'List Field Options on a Custom Field',
    'description' => 'List Field Options on a Custom Field List field options for a custom field. Custom Fields (CF) are a feature which will allow customers to extend Incidents with their own custom data, to provide additional context and support features such as customized filtering, search and analytics. Custom Fields can be applied to different incident types. Scoped OAuth requires: `custom_fields.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_incident_type_custom_fields' =>
  array (
    'slug' => 'pagerduty_list_incident_type_custom_fields',
    'class' => 'PagerdutyListIncidentTypeCustomFields',
    'method' => 'GET',
    'path' => '/incidents/types/{type_id_or_name}/custom_fields',
    'operation_id' => 'listIncidentTypeCustomFields',
    'name' => 'List Incident Type Custom Fields',
    'description' => 'List Incident Type Custom Fields List the custom fields for an incident type. Custom Fields (CF) are a feature which will allow customers to extend Incidents with their own custom data, to provide additional context and support features such as customized filtering, search and analytics. Custom Fields can be applied to different incident types. Scoped OAuth requires: `custom_fields.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_incident_types' =>
  array (
    'slug' => 'pagerduty_list_incident_types',
    'class' => 'PagerdutyListIncidentTypes',
    'method' => 'GET',
    'path' => '/incidents/types',
    'operation_id' => 'listIncidentTypes',
    'name' => 'List incident types',
    'description' => 'List incident types List the available incident types Incident Types are a feature which will allow customers to categorize incidents, such as a security incident, a major incident, or a fraud incident. These can be filtered by enabled or disabled types. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidentType) Scoped OAuth requires: `incident_types.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_incident_workflow_actions' =>
  array (
    'slug' => 'pagerduty_list_incident_workflow_actions',
    'class' => 'PagerdutyListIncidentWorkflowActions',
    'method' => 'GET',
    'path' => '/incident_workflows/actions',
    'operation_id' => 'listIncidentWorkflowActions',
    'name' => 'List Actions',
    'description' => 'List Actions List Incident Workflow Actions Scoped OAuth requires: `incident_workflows.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_incident_workflow_triggers' =>
  array (
    'slug' => 'pagerduty_list_incident_workflow_triggers',
    'class' => 'PagerdutyListIncidentWorkflowTriggers',
    'method' => 'GET',
    'path' => '/incident_workflows/triggers',
    'operation_id' => 'listIncidentWorkflowTriggers',
    'name' => 'List Triggers',
    'description' => 'List Triggers List existing Incident Workflow Triggers Scoped OAuth requires: `incident_workflows.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_incident_workflows' =>
  array (
    'slug' => 'pagerduty_list_incident_workflows',
    'class' => 'PagerdutyListIncidentWorkflows',
    'method' => 'GET',
    'path' => '/incident_workflows',
    'operation_id' => 'listIncidentWorkflows',
    'name' => 'List Incident Workflows',
    'description' => 'List Incident Workflows List existing Incident Workflows. This is the best method to use to list all Incident Workflows in your account. If your use case requires listing Incident Workflows associated with a particular Service, you can use the "List Triggers" method to find Incident Workflows configured to start for Incidents in a given Service. An Incident Workflow is a sequence of configurable Steps and associated Triggers that can execute automated Actions for a given Incident. Scoped OAuth requires: `incident_workflows.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_incidents' =>
  array (
    'slug' => 'pagerduty_list_incidents',
    'class' => 'PagerdutyListIncidents',
    'method' => 'GET',
    'path' => '/incidents',
    'operation_id' => 'listIncidents',
    'name' => 'List incidents',
    'description' => 'List incidents List existing incidents. An incident represents a problem or an issue that needs to be addressed and resolved. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_license_allocations' =>
  array (
    'slug' => 'pagerduty_list_license_allocations',
    'class' => 'PagerdutyListLicenseAllocations',
    'method' => 'GET',
    'path' => '/license_allocations',
    'operation_id' => 'listLicenseAllocations',
    'name' => 'List License Allocations',
    'description' => 'List License Allocations List the Licenses allocated to Users within your Account Scoped OAuth requires: `licenses.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_licenses' =>
  array (
    'slug' => 'pagerduty_list_licenses',
    'class' => 'PagerdutyListLicenses',
    'method' => 'GET',
    'path' => '/licenses',
    'operation_id' => 'listLicenses',
    'name' => 'List Licenses',
    'description' => 'List Licenses List the Licenses associated with your Account Scoped OAuth requires: `licenses.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_log_entries' =>
  array (
    'slug' => 'pagerduty_list_log_entries',
    'class' => 'PagerdutyListLogEntries',
    'method' => 'GET',
    'path' => '/log_entries',
    'operation_id' => 'listLogEntries',
    'name' => 'List log entries',
    'description' => 'List log entries List all of the incident log entries across the entire account. A log of all the events that happen to an Incident, and these are exposed as Log Entries. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#log-entries) Scoped OAuth requires: `incidents.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_maintenance_windows' =>
  array (
    'slug' => 'pagerduty_list_maintenance_windows',
    'class' => 'PagerdutyListMaintenanceWindows',
    'method' => 'GET',
    'path' => '/maintenance_windows',
    'operation_id' => 'listMaintenanceWindows',
    'name' => 'List maintenance windows',
    'description' => 'List maintenance windows List existing maintenance windows, optionally filtered by service and/or team, or whether they are from the past, present or future. A Maintenance Window is used to temporarily disable one or more Services for a set period of time. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#maintenance-windows) Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_notifications' =>
  array (
    'slug' => 'pagerduty_list_notifications',
    'class' => 'PagerdutyListNotifications',
    'method' => 'GET',
    'path' => '/notifications',
    'operation_id' => 'listNotifications',
    'name' => 'List notifications',
    'description' => 'List notifications for a given time range, optionally filtered by type (sms_notification, email_notification, phone_notification, or push_notification). A Notification is created when an Incident is triggered or escalated. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#notifications) Scoped OAuth requires: `users:notifications.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_oauth_clients' =>
  array (
    'slug' => 'pagerduty_list_oauth_clients',
    'class' => 'PagerdutyListOauthClients',
    'method' => 'GET',
    'path' => '/webhook_subscriptions/oauth_clients',
    'operation_id' => 'listOauthClients',
    'name' => 'List OAuth clients',
    'description' => 'List OAuth clients List all OAuth clients for webhook subscriptions. Maximum of 10 clients per account. Requires admin or owner role permissions.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_on_calls' =>
  array (
    'slug' => 'pagerduty_list_on_calls',
    'class' => 'PagerdutyListOnCalls',
    'method' => 'GET',
    'path' => '/oncalls',
    'operation_id' => 'listOnCalls',
    'name' => 'List all of the on-calls',
    'description' => 'List all of the on-calls List the on-call entries during a given time range. An on-call represents a contiguous unit of time for which a User will be on call for a given Escalation Policy and Escalation Rules. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#on-calls) Scoped OAuth requires: `oncalls.read` This API operation has operation specific rate limits. See the [Rate Limits](https://developer.pagerduty.com/docs/72d3b724589e3-rest-api-rate-limits) page for more information.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_orchestration_integrations' =>
  array (
    'slug' => 'pagerduty_list_orchestration_integrations',
    'class' => 'PagerdutyListOrchestrationIntegrations',
    'method' => 'GET',
    'path' => '/event_orchestrations/{id}/integrations',
    'operation_id' => 'listOrchestrationIntegrations',
    'name' => 'List Integrations for an Event Orchestration',
    'description' => 'List Integrations for an Event Orchestration List the Integrations associated with this Event Orchestrations. You can use a Routing Key from these Integrations to send events to PagerDuty! For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_overrides' =>
  array (
    'slug' => 'pagerduty_list_overrides',
    'class' => 'PagerdutyListOverrides',
    'method' => 'GET',
    'path' => '/v3/schedules/{id}/overrides',
    'operation_id' => 'listOverrides',
    'name' => 'List overrides',
    'description' => 'List overrides <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Retrieve overrides for a schedule within a time range. **`since` and `until` are required.**',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_priorities' =>
  array (
    'slug' => 'pagerduty_list_priorities',
    'class' => 'PagerdutyListPriorities',
    'method' => 'GET',
    'path' => '/priorities',
    'operation_id' => 'listPriorities',
    'name' => 'List priorities',
    'description' => 'List priorities List existing priorities, in order (most to least severe). A priority is a label representing the importance and impact of an incident. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#priorities) Scoped OAuth requires: `priorities.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_resource_standards' =>
  array (
    'slug' => 'pagerduty_list_resource_standards',
    'class' => 'PagerdutyListResourceStandards',
    'method' => 'GET',
    'path' => '/standards/scores/{resource_type}/{id}',
    'operation_id' => 'listResourceStandards',
    'name' => 'List a resource\'s standards scores',
    'description' => 'List a resource\'s standards scores List standards applied to a specific resource Scoped OAuth requires: `standards.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_resource_standards_many_services' =>
  array (
    'slug' => 'pagerduty_list_resource_standards_many_services',
    'class' => 'PagerdutyListResourceStandardsManyServices',
    'method' => 'GET',
    'path' => '/standards/scores/{resource_type}',
    'operation_id' => 'listResourceStandardsManyServices',
    'name' => 'List resources\' standards scores',
    'description' => 'List resources\' standards scores List standards applied to a set of resources Scoped OAuth requires: `standards.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_rotations' =>
  array (
    'slug' => 'pagerduty_list_rotations',
    'class' => 'PagerdutyListRotations',
    'method' => 'GET',
    'path' => '/v3/schedules/{id}/rotations',
    'operation_id' => 'listRotations',
    'name' => 'List rotations',
    'description' => 'List rotations <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Retrieve all rotations for a schedule.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_ruleset_event_rules' =>
  array (
    'slug' => 'pagerduty_list_ruleset_event_rules',
    'class' => 'PagerdutyListRulesetEventRules',
    'method' => 'GET',
    'path' => '/rulesets/{id}/rules',
    'operation_id' => 'listRulesetEventRules',
    'name' => 'List Event Rules',
    'description' => 'List Event Rules List all Event Rules on a Ruleset. <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Rulesets allow you to route events to an endpoint and create collections of Event Rules, which define sets of actions to take based on event content. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#rulesets) Note: Create and Update on rules will accept \'description\' or \'summary\' interchangeably as an extraction action target. Get and List on rules will always return \'summary\' as the target. If you are expecting \'description\' please change your automation code to expect \'summary\' instead. Scoped OAuth requires: `event_rules.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_rulesets' =>
  array (
    'slug' => 'pagerduty_list_rulesets',
    'class' => 'PagerdutyListRulesets',
    'method' => 'GET',
    'path' => '/rulesets',
    'operation_id' => 'listRulesets',
    'name' => 'List Rulesets',
    'description' => 'List Rulesets List all Rulesets <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Rulesets allow you to route events to an endpoint and create collections of Event Rules, which define sets of actions to take based on event content. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#rulesets) Scoped OAuth requires: `event_rules.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_schedule_overrides' =>
  array (
    'slug' => 'pagerduty_list_schedule_overrides',
    'class' => 'PagerdutyListScheduleOverrides',
    'method' => 'GET',
    'path' => '/schedules/{id}/overrides',
    'operation_id' => 'listScheduleOverrides',
    'name' => 'List overrides',
    'description' => 'List overrides for a given time range. A Schedule determines the time periods that users are On-Call. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#schedules) Scoped OAuth requires: `schedules.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_schedule_users' =>
  array (
    'slug' => 'pagerduty_list_schedule_users',
    'class' => 'PagerdutyListScheduleUsers',
    'method' => 'GET',
    'path' => '/schedules/{id}/users',
    'operation_id' => 'listScheduleUsers',
    'name' => 'List users on call.',
    'description' => 'List users on call. List all of the users on call in a given schedule for a given time range. A Schedule determines the time periods that users are On-Call. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#schedules) Scoped OAuth requires: `users.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_schedules' =>
  array (
    'slug' => 'pagerduty_list_schedules',
    'class' => 'PagerdutyListSchedules',
    'method' => 'GET',
    'path' => '/schedules',
    'operation_id' => 'listSchedules',
    'name' => 'List schedules',
    'description' => 'List schedules List the on-call schedules. A Schedule determines the time periods that users are On-Call. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#schedules) Scoped OAuth requires: `schedules.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_schedules_audit_records' =>
  array (
    'slug' => 'pagerduty_list_schedules_audit_records',
    'class' => 'PagerdutyListSchedulesAuditRecords',
    'method' => 'GET',
    'path' => '/schedules/{id}/audit/records',
    'operation_id' => 'listSchedulesAuditRecords',
    'name' => 'List audit records for a schedule',
    'description' => 'List audit records for a schedule The returned records are sorted by the `execution_time` from newest to oldest. See [`Cursor-based pagination`](https://developer.pagerduty.com/docs/rest-api-v2/pagination/) for instructions on how to paginate through the result set. For more information see the [Audit API Document](https://developer.pagerduty.com/docs/rest-api-v2/audit-records-api/). Scoped OAuth requires: `audit_records.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_schedules_audit_records_v3' =>
  array (
    'slug' => 'pagerduty_list_schedules_audit_records_v3',
    'class' => 'PagerdutyListSchedulesAuditRecordsV3',
    'method' => 'GET',
    'path' => '/v3/schedules/{id}/audit/records',
    'operation_id' => 'listSchedulesAuditRecordsV3',
    'name' => 'List audit records for a schedule',
    'description' => 'List audit records for a schedule <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). The returned records are sorted by the `execution_time` from newest to oldest. See [`Cursor-based pagination`](https://developer.pagerduty.com/docs/rest-api-v2/pagination/) for instructions on how to paginate through the result set. For more information see the [Audit API Document](https://developer.pagerduty.com/docs/rest-api-v2/audit-records-api/). Scoped OAuth requires: `audit_records.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_schedules_v3' =>
  array (
    'slug' => 'pagerduty_list_schedules_v3',
    'class' => 'PagerdutyListSchedulesV3',
    'method' => 'GET',
    'path' => '/v3/schedules',
    'operation_id' => 'listSchedulesV3',
    'name' => 'List schedules',
    'description' => 'List schedules <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Retrieve a paginated list of schedule references. Returns lightweight objects without embedded rotations or events. Each result is filtered by the caller\'s read permission; schedules the caller cannot read are silently excluded.',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_service_audit_records' =>
  array (
    'slug' => 'pagerduty_list_service_audit_records',
    'class' => 'PagerdutyListServiceAuditRecords',
    'method' => 'GET',
    'path' => '/services/{id}/audit/records',
    'operation_id' => 'listServiceAuditRecords',
    'name' => 'List audit records for a service',
    'description' => 'List audit records for a service The returned records are sorted by the `execution_time` from newest to oldest. See [`Cursor-based pagination`](https://developer.pagerduty.com/docs/rest-api-v2/pagination/) for instructions on how to paginate through the result set. For more information see the [Audit API Document](https://developer.pagerduty.com/docs/rest-api-v2/audit-records-api/). Scoped OAuth requires: `audit_records.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_service_change_events' =>
  array (
    'slug' => 'pagerduty_list_service_change_events',
    'class' => 'PagerdutyListServiceChangeEvents',
    'method' => 'GET',
    'path' => '/services/{id}/change_events',
    'operation_id' => 'listServiceChangeEvents',
    'name' => 'List Change Events for a service',
    'description' => 'List Change Events for a service List all of the existing Change Events for a service. Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_service_custom_field_options' =>
  array (
    'slug' => 'pagerduty_list_service_custom_field_options',
    'class' => 'PagerdutyListServiceCustomFieldOptions',
    'method' => 'GET',
    'path' => '/services/custom_fields/{field_id}/field_options',
    'operation_id' => 'listServiceCustomFieldOptions',
    'name' => 'List Field Options',
    'description' => 'List Field Options List all options for a given field. Scoped OAuth requires: `custom_fields.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_service_custom_fields' =>
  array (
    'slug' => 'pagerduty_list_service_custom_fields',
    'class' => 'PagerdutyListServiceCustomFields',
    'method' => 'GET',
    'path' => '/services/custom_fields',
    'operation_id' => 'listServiceCustomFields',
    'name' => 'List Fields',
    'description' => 'List Fields List Custom Fields available for Services. Scoped OAuth requires: `custom_fields.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_service_event_rules' =>
  array (
    'slug' => 'pagerduty_list_service_event_rules',
    'class' => 'PagerdutyListServiceEventRules',
    'method' => 'GET',
    'path' => '/services/{id}/rules',
    'operation_id' => 'listServiceEventRules',
    'name' => 'List Service\'s Event Rules',
    'description' => 'List Service\'s Event Rules List Event Rules on a Service. <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_service_feature_enablements' =>
  array (
    'slug' => 'pagerduty_list_service_feature_enablements',
    'class' => 'PagerdutyListServiceFeatureEnablements',
    'method' => 'GET',
    'path' => '/services/{id}/enablements',
    'operation_id' => 'listServiceFeatureEnablements',
    'name' => 'Get Enablements for a Service',
    'description' => 'Get Enablements for a Service List all feature enablement settings for a service. Currently, only the `aiops` enablement is supported. For any account with the AIOps product addon, every service will have AIOps features enabled by default. **Warning conditions**: - If the account is not entitled to use AIOps features, a warning will be returned alongside the enablement data. Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_services' =>
  array (
    'slug' => 'pagerduty_list_services',
    'class' => 'PagerdutyListServices',
    'method' => 'GET',
    'path' => '/services',
    'operation_id' => 'listServices',
    'name' => 'List services',
    'description' => 'List services List existing Services. A service may represent an application, component, or team you wish to open incidents against. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#services) Scoped OAuth requires: `services.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_sre_memories' =>
  array (
    'slug' => 'pagerduty_list_sre_memories',
    'class' => 'PagerdutyListSreMemories',
    'method' => 'GET',
    'path' => '/sre_agent/memories',
    'operation_id' => 'listSreMemories',
    'name' => 'List SRE Agent memories',
    'description' => 'List SRE Agent memories Search SRE Agent memories for the account. Memories are knowledge learned by the SRE Agent, including service runbooks, service profiles, incident playbooks, and incident summaries. Filter by service ID, incident ID, or memory type to retrieve relevant memories. Scoped OAuth requires: `incident.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_standards' =>
  array (
    'slug' => 'pagerduty_list_standards',
    'class' => 'PagerdutyListStandards',
    'method' => 'GET',
    'path' => '/standards',
    'operation_id' => 'listStandards',
    'name' => 'List Standards',
    'description' => 'List Standards Get all standards of an account. Scoped OAuth requires: `standards.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_status_dashboards' =>
  array (
    'slug' => 'pagerduty_list_status_dashboards',
    'class' => 'PagerdutyListStatusDashboards',
    'method' => 'GET',
    'path' => '/status_dashboards',
    'operation_id' => 'listStatusDashboards',
    'name' => 'List Status Dashboards',
    'description' => 'List Status Dashboards Get all your account\'s custom Status Dashboard views. Scoped OAuth requires: `status_dashboards.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_status_page_impacts' =>
  array (
    'slug' => 'pagerduty_list_status_page_impacts',
    'class' => 'PagerdutyListStatusPageImpacts',
    'method' => 'GET',
    'path' => '/status_pages/{id}/impacts',
    'operation_id' => 'listStatusPageImpacts',
    'name' => 'List Status Page Impacts',
    'description' => 'List Status Page Impacts List Impacts for a Status Page by Status Page ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_status_page_post_updates' =>
  array (
    'slug' => 'pagerduty_list_status_page_post_updates',
    'class' => 'PagerdutyListStatusPagePostUpdates',
    'method' => 'GET',
    'path' => '/status_pages/{id}/posts/{post_id}/post_updates',
    'operation_id' => 'listStatusPagePostUpdates',
    'name' => 'List Status Page Post Updates',
    'description' => 'List Status Page Post Updates List Post Updates for a Status Page by Status Page ID and Post ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_status_page_posts' =>
  array (
    'slug' => 'pagerduty_list_status_page_posts',
    'class' => 'PagerdutyListStatusPagePosts',
    'method' => 'GET',
    'path' => '/status_pages/{id}/posts',
    'operation_id' => 'listStatusPagePosts',
    'name' => 'List Status Page Posts',
    'description' => 'List Status Page Posts List Posts for a Status Page by Status Page ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_status_page_services' =>
  array (
    'slug' => 'pagerduty_list_status_page_services',
    'class' => 'PagerdutyListStatusPageServices',
    'method' => 'GET',
    'path' => '/status_pages/{id}/services',
    'operation_id' => 'listStatusPageServices',
    'name' => 'List Status Page Services',
    'description' => 'List Status Page Services List Services for a Status Page by Status Page ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_status_page_severities' =>
  array (
    'slug' => 'pagerduty_list_status_page_severities',
    'class' => 'PagerdutyListStatusPageSeverities',
    'method' => 'GET',
    'path' => '/status_pages/{id}/severities',
    'operation_id' => 'listStatusPageSeverities',
    'name' => 'List Status Page Severities',
    'description' => 'List Status Page Severities List Severities for a Status Page by Status Page ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_status_page_statuses' =>
  array (
    'slug' => 'pagerduty_list_status_page_statuses',
    'class' => 'PagerdutyListStatusPageStatuses',
    'method' => 'GET',
    'path' => '/status_pages/{id}/statuses',
    'operation_id' => 'listStatusPageStatuses',
    'name' => 'List Status Page Statuses',
    'description' => 'List Status Page Statuses List Statuses for a Status Page by Status Page ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_status_page_subscriptions' =>
  array (
    'slug' => 'pagerduty_list_status_page_subscriptions',
    'class' => 'PagerdutyListStatusPageSubscriptions',
    'method' => 'GET',
    'path' => '/status_pages/{id}/subscriptions',
    'operation_id' => 'listStatusPageSubscriptions',
    'name' => 'List Status Page Subscriptions',
    'description' => 'List Status Page Subscriptions List Subscriptions for a Status Page by Status Page ID. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_status_pages' =>
  array (
    'slug' => 'pagerduty_list_status_pages',
    'class' => 'PagerdutyListStatusPages',
    'method' => 'GET',
    'path' => '/status_pages',
    'operation_id' => 'listStatusPages',
    'name' => 'List Status Pages',
    'description' => 'List Status Pages. Scoped OAuth requires: `status_pages.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_tags' =>
  array (
    'slug' => 'pagerduty_list_tags',
    'class' => 'PagerdutyListTags',
    'method' => 'GET',
    'path' => '/tags',
    'operation_id' => 'listTags',
    'name' => 'List tags',
    'description' => 'List tags List all of your account\'s tags. A Tag is applied to Escalation Policies, Teams or Users and can be used to filter them. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#tags) Scoped OAuth requires: `tags.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_team_users' =>
  array (
    'slug' => 'pagerduty_list_team_users',
    'class' => 'PagerdutyListTeamUsers',
    'method' => 'GET',
    'path' => '/teams/{id}/members',
    'operation_id' => 'listTeamUsers',
    'name' => 'List members of a team',
    'description' => 'List members of a team Get information about members on a team. A team is a collection of Users and Escalation Policies that represent a group of people within an organization. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#teams) Scoped OAuth requires: `teams.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_teams' =>
  array (
    'slug' => 'pagerduty_list_teams',
    'class' => 'PagerdutyListTeams',
    'method' => 'GET',
    'path' => '/teams',
    'operation_id' => 'listTeams',
    'name' => 'List teams',
    'description' => 'List teams of your PagerDuty account, optionally filtered by a search query. A team is a collection of Users and Escalation Policies that represent a group of people within an organization. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#teams) Scoped OAuth requires: `teams.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_teams_audit_records' =>
  array (
    'slug' => 'pagerduty_list_teams_audit_records',
    'class' => 'PagerdutyListTeamsAuditRecords',
    'method' => 'GET',
    'path' => '/teams/{id}/audit/records',
    'operation_id' => 'listTeamsAuditRecords',
    'name' => 'List audit records for a team',
    'description' => 'List audit records for a team The returned records are sorted by the `execution_time` from newest to oldest. See [`Cursor-based pagination`](https://developer.pagerduty.com/docs/rest-api-v2/pagination/) for instructions on how to paginate through the result set. For more information see the [Audit API Document](https://developer.pagerduty.com/docs/rest-api-v2/audit-records-api/). Scoped OAuth requires: `audit_records.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_user_delegations' =>
  array (
    'slug' => 'pagerduty_list_user_delegations',
    'class' => 'PagerdutyListUserDelegations',
    'method' => 'GET',
    'path' => '/users/{id}/oauth_delegations',
    'operation_id' => 'listUserDelegations',
    'name' => 'List a user\'s delegations',
    'description' => 'List a user\'s delegations Get a list of OAuth delegations for a specific user. This endpoint replaces the deprecated `/users/{id}/sessions` endpoint. **Required OAuth Scope:** For Scoped OAuth requests, this operation requires the `oauth_delegations.read` scope. Scoped OAuth requires: `oauth_delegations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_users' =>
  array (
    'slug' => 'pagerduty_list_users',
    'class' => 'PagerdutyListUsers',
    'method' => 'GET',
    'path' => '/users',
    'operation_id' => 'listUsers',
    'name' => 'List users',
    'description' => 'List users of your PagerDuty account, optionally filtered by a search query. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_users_audit_records' =>
  array (
    'slug' => 'pagerduty_list_users_audit_records',
    'class' => 'PagerdutyListUsersAuditRecords',
    'method' => 'GET',
    'path' => '/users/{id}/audit/records',
    'operation_id' => 'listUsersAuditRecords',
    'name' => 'List audit records for a user',
    'description' => 'List audit records for a user The response will include audit records with changes that are made to the identified user not changes made by the identified user. The returned records are sorted by the `execution_time` from newest to oldest. See [`Cursor-based pagination`](https://developer.pagerduty.com/docs/rest-api-v2/pagination/) for instructions on how to paginate through the result set. For more information see the [Audit API Document](https://developer.pagerduty.com/docs/rest-api-v2/audit-records-api/). Scoped OAuth requires: `audit_records.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_vendors' =>
  array (
    'slug' => 'pagerduty_list_vendors',
    'class' => 'PagerdutyListVendors',
    'method' => 'GET',
    'path' => '/vendors',
    'operation_id' => 'listVendors',
    'name' => 'List vendors',
    'description' => 'List vendors List all vendors. A PagerDuty Vendor represents a specific type of integration. AWS Cloudwatch, Splunk, Datadog are all examples of vendors For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#vendors) Scoped OAuth requires: `vendors.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_webhook_subscriptions' =>
  array (
    'slug' => 'pagerduty_list_webhook_subscriptions',
    'class' => 'PagerdutyListWebhookSubscriptions',
    'method' => 'GET',
    'path' => '/webhook_subscriptions',
    'operation_id' => 'listWebhookSubscriptions',
    'name' => 'List webhook subscriptions',
    'description' => 'List webhook subscriptions List existing webhook subscriptions. The `filter_type` and `filter_id` query parameters may be used to only show subscriptions for a particular _service_ or _team_. For more information on webhook subscriptions and how they are used to configure v3 webhooks see the [Webhooks v3 Developer Documentation](https://developer.pagerduty.com/docs/webhooks/v3-overview/). Scoped OAuth requires: `webhook_subscriptions.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_workflow_integration_connections' =>
  array (
    'slug' => 'pagerduty_list_workflow_integration_connections',
    'class' => 'PagerdutyListWorkflowIntegrationConnections',
    'method' => 'GET',
    'path' => '/workflows/integrations/connections',
    'operation_id' => 'listWorkflowIntegrationConnections',
    'name' => 'List all Workflow Integration Connections',
    'description' => 'List all Workflow Integration Connections. Scoped OAuth requires: `workflow_integrations:connections.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_workflow_integration_connections_by_integration' =>
  array (
    'slug' => 'pagerduty_list_workflow_integration_connections_by_integration',
    'class' => 'PagerdutyListWorkflowIntegrationConnectionsByIntegration',
    'method' => 'GET',
    'path' => '/workflows/integrations/{integration_id}/connections',
    'operation_id' => 'listWorkflowIntegrationConnectionsByIntegration',
    'name' => 'List Workflow Integration Connections',
    'description' => 'List Workflow Integration Connections List all Workflow Integration Connections for a specific Workflow Integration. Scoped OAuth requires: `workflow_integrations:connections.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_list_workflow_integrations' =>
  array (
    'slug' => 'pagerduty_list_workflow_integrations',
    'class' => 'PagerdutyListWorkflowIntegrations',
    'method' => 'GET',
    'path' => '/workflows/integrations',
    'operation_id' => 'listWorkflowIntegrations',
    'name' => 'List Workflow Integrations',
    'description' => 'List Workflow Integrations List available Workflow Integrations. Scoped OAuth requires: `workflow_integrations.read`',
    'type' => 'read',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_merge_incidents' =>
  array (
    'slug' => 'pagerduty_merge_incidents',
    'class' => 'PagerdutyMergeIncidents',
    'method' => 'PUT',
    'path' => '/incidents/{id}/merge',
    'operation_id' => 'mergeIncidents',
    'name' => 'Merge incidents',
    'description' => 'Merge incidents Merge a list of source incidents into the target [incident](https://developer.pagerduty.com/api-reference/a47605517c19a-api-concepts#incidents). After the merge is performed the target incident will contain the source incidents\' [alerts](https://developer.pagerduty.com/api-reference/a47605517c19a-api-concepts#alerts), and the source incidents will be resolved. Only incidents that have alerts or incidents that were created manually in the UI can be merged. Open incidents cannot be merged into a resolved incident. An incident cannot have more than 1000 alerts. The server will return an error if merging the source incidents will result in the target incident having more than 1000 alerts. Scoped OAuth requires: `incidents.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_migrate_orchestration_integration' =>
  array (
    'slug' => 'pagerduty_migrate_orchestration_integration',
    'class' => 'PagerdutyMigrateOrchestrationIntegration',
    'method' => 'POST',
    'path' => '/event_orchestrations/{id}/integrations/migration',
    'operation_id' => 'migrateOrchestrationIntegration',
    'name' => 'Migrate an Integration from one Event Orchestration to another',
    'description' => 'Migrate an Integration from one Event Orchestration to another Move an Integration and its Routing Key from the Event Orchestration specified in the request payload, to the Event Orchestration specified in the request URL. Any future events sent to this Integration\'s Routing Key will be processed by this Event Orchestration\'s Rules. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_post_alert_grouping_settings' =>
  array (
    'slug' => 'pagerduty_post_alert_grouping_settings',
    'class' => 'PagerdutyPostAlertGroupingSettings',
    'method' => 'POST',
    'path' => '/alert_grouping_settings',
    'operation_id' => 'postAlertGroupingSettings',
    'name' => 'Create an Alert Grouping Setting',
    'description' => 'Create an Alert Grouping Setting Create a new Alert Grouping Setting. The settings part of Alert Grouper service allows us to create Alert Grouping Settings and configs that are required to be used during grouping of the alerts. This endpoint will be used to create an instance of AlertGroupingSettings for either one service or many services that are in the alert group setting. Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_post_incident_workflow' =>
  array (
    'slug' => 'pagerduty_post_incident_workflow',
    'class' => 'PagerdutyPostIncidentWorkflow',
    'method' => 'POST',
    'path' => '/incident_workflows',
    'operation_id' => 'postIncidentWorkflow',
    'name' => 'Create an Incident Workflow',
    'description' => 'Create an Incident Workflow Create a new Incident Workflow An Incident Workflow is a sequence of configurable Steps and associated Triggers that can execute automated Actions for a given Incident. Scoped OAuth requires: `incident_workflows.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_post_orchestration' =>
  array (
    'slug' => 'pagerduty_post_orchestration',
    'class' => 'PagerdutyPostOrchestration',
    'method' => 'POST',
    'path' => '/event_orchestrations',
    'operation_id' => 'postOrchestration',
    'name' => 'Create an Orchestration',
    'description' => 'Create an Orchestration Create a Global Event Orchestration. Global Event Orchestrations allow you define a set of Global Rules and Router Rules, so that when you ingest events using the Orchestration\'s Routing Key your events will have actions applied via the Global Rules & then routed to the correct Service by the Router Rules, based on the event\'s content. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_post_orchestration_integration' =>
  array (
    'slug' => 'pagerduty_post_orchestration_integration',
    'class' => 'PagerdutyPostOrchestrationIntegration',
    'method' => 'POST',
    'path' => '/event_orchestrations/{id}/integrations',
    'operation_id' => 'postOrchestrationIntegration',
    'name' => 'Create an Integration for an Event Orchestration',
    'description' => 'Create an Integration for an Event Orchestration Create an Integration associated with this Event Orchestration. You can then use the Routing Key from this new Integration to send events to PagerDuty! For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_put_alert_grouping_setting' =>
  array (
    'slug' => 'pagerduty_put_alert_grouping_setting',
    'class' => 'PagerdutyPutAlertGroupingSetting',
    'method' => 'PUT',
    'path' => '/alert_grouping_settings/{id}',
    'operation_id' => 'putAlertGroupingSetting',
    'name' => 'Update an Alert Grouping Setting',
    'description' => 'Update an Alert Grouping Setting. The settings part of Alert Grouper service allows us to create Alert Grouping Settings and configs that are required to be used during grouping of the alerts. if `services` are not provided in the request, then the existing services will not be removed from the setting. Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_put_business_service_priority_thresholds' =>
  array (
    'slug' => 'pagerduty_put_business_service_priority_thresholds',
    'class' => 'PagerdutyPutBusinessServicePriorityThresholds',
    'method' => 'PUT',
    'path' => '/business_services/priority_thresholds',
    'operation_id' => 'putBusinessServicePriorityThresholds',
    'name' => 'Set the Account-level priority threshold for Business Service impact.',
    'description' => 'Set the Account-level priority threshold for Business Service impact. Set the Account-level priority threshold for Business Service. Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Set the `id` and `order` of the global Priority Threshold. These values can be obtained by calling the `/priorities` endpoint. Once set, Incidents must be at or above the specified level in order to impact Business Services. An exception to this rule is if the Incident has been added to the incident directly using the `PUT /incidents/{id}/business_services/{business_service_id}/impacts` endpoint.',
    ),
  ),
  'pagerduty_put_incident_manual_business_service_association' =>
  array (
    'slug' => 'pagerduty_put_incident_manual_business_service_association',
    'class' => 'PagerdutyPutIncidentManualBusinessServiceAssociation',
    'method' => 'PUT',
    'path' => '/incidents/{id}/business_services/{business_service_id}/impacts',
    'operation_id' => 'putIncidentManualBusinessServiceAssociation',
    'name' => 'Manually change an Incident\'s Impact on a Business Service.',
    'description' => 'Manually change an Incident\'s Impact on a Business Service. Change Impact of an Incident on a Business Service. Scoped OAuth requires: `incidents.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The `impacted` relation will cause the Business Service and any Services that it supports to become impacted by this incident. The `not_impacted` relation will remove the Incident\'s Impact from the specified Business Service. The effect of adding or removing Impact to a Business Service in this way will also change the propagation of Impact to other Services supported by that Business Service.',
    ),
  ),
  'pagerduty_put_incident_workflow' =>
  array (
    'slug' => 'pagerduty_put_incident_workflow',
    'class' => 'PagerdutyPutIncidentWorkflow',
    'method' => 'PUT',
    'path' => '/incident_workflows/{id}',
    'operation_id' => 'putIncidentWorkflow',
    'name' => 'Update an Incident Workflow',
    'description' => 'Update an Incident Workflow An Incident Workflow is a sequence of configurable Steps and associated Triggers that can execute automated Actions for a given Incident. Scoped OAuth requires: `incident_workflows.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_remove_business_service_account_subscription' =>
  array (
    'slug' => 'pagerduty_remove_business_service_account_subscription',
    'class' => 'PagerdutyRemoveBusinessServiceAccountSubscription',
    'method' => 'DELETE',
    'path' => '/business_services/{id}/account_subscription',
    'operation_id' => 'removeBusinessServiceAccountSubscription',
    'name' => 'Delete Business Service Account Subscription',
    'description' => 'Delete Business Service Account Subscription Unsubscribe your Account from a Business Service. Scoped OAuth requires: `subscribers.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_remove_business_service_notification_subscriber' =>
  array (
    'slug' => 'pagerduty_remove_business_service_notification_subscriber',
    'class' => 'PagerdutyRemoveBusinessServiceNotificationSubscriber',
    'method' => 'POST',
    'path' => '/business_services/{id}/unsubscribe',
    'operation_id' => 'removeBusinessServiceNotificationSubscriber',
    'name' => 'Remove Business Service Subscribers',
    'description' => 'Remove Business Service Subscribers Unsubscribes the matching Subscribers from a Business Service. Scoped OAuth requires: `subscribers.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The entities to unsubscribe.',
    ),
  ),
  'pagerduty_remove_incident_notification_subscribers' =>
  array (
    'slug' => 'pagerduty_remove_incident_notification_subscribers',
    'class' => 'PagerdutyRemoveIncidentNotificationSubscribers',
    'method' => 'POST',
    'path' => '/incidents/{id}/status_updates/unsubscribe',
    'operation_id' => 'removeIncidentNotificationSubscribers',
    'name' => 'Remove Notification Subscriber',
    'description' => 'Remove Notification Subscriber Unsubscribes the matching Subscribers from Incident Status Update Notifications. Scoped OAuth requires: `subscribers.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The entities to unsubscribe.',
    ),
  ),
  'pagerduty_remove_team_notification_subscriptions' =>
  array (
    'slug' => 'pagerduty_remove_team_notification_subscriptions',
    'class' => 'PagerdutyRemoveTeamNotificationSubscriptions',
    'method' => 'POST',
    'path' => '/teams/{id}/notification_subscriptions/unsubscribe',
    'operation_id' => 'removeTeamNotificationSubscriptions',
    'name' => 'remove Team Notification Subscriptions',
    'description' => 'Unsubscribe the given Team from Notifications on the matching Subscribable entities. Scoped OAuth requires: `subscribers.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The entities to unsubscribe from.',
    ),
  ),
  'pagerduty_render_template' =>
  array (
    'slug' => 'pagerduty_render_template',
    'class' => 'PagerdutyRenderTemplate',
    'method' => 'POST',
    'path' => '/templates/{id}/render',
    'operation_id' => 'renderTemplate',
    'name' => 'Render a template',
    'description' => 'Render a template. This endpoint has a variable request body depending on the template type. For the `status_update` template type, the caller will provide the incident id, and a status update message. Scoped OAuth requires: `templates.read`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_set_incident_field_values' =>
  array (
    'slug' => 'pagerduty_set_incident_field_values',
    'class' => 'PagerdutySetIncidentFieldValues',
    'method' => 'PUT',
    'path' => '/incidents/{id}/custom_fields/values',
    'operation_id' => 'setIncidentFieldValues',
    'name' => 'Update Custom Field Values',
    'description' => 'Update Custom Field Values Set custom field values for an incident. Scoped OAuth requires: `incidents.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_test_webhook_subscription' =>
  array (
    'slug' => 'pagerduty_test_webhook_subscription',
    'class' => 'PagerdutyTestWebhookSubscription',
    'method' => 'POST',
    'path' => '/webhook_subscriptions/{id}/ping',
    'operation_id' => 'testWebhookSubscription',
    'name' => 'Test a webhook subscription',
    'description' => 'Test a webhook subscription. Fires a test event against the webhook subscription. If properly configured, this will deliver the `pagey.ping` webhook event to the destination. Scoped OAuth requires: `webhook_subscriptions.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_unsubscribe_user_notification_subscriptions' =>
  array (
    'slug' => 'pagerduty_unsubscribe_user_notification_subscriptions',
    'class' => 'PagerdutyUnsubscribeUserNotificationSubscriptions',
    'method' => 'POST',
    'path' => '/users/{id}/notification_subscriptions/unsubscribe',
    'operation_id' => 'unsubscribeUserNotificationSubscriptions',
    'name' => 'Remove Notification Subscriptions',
    'description' => 'Remove Notification Subscriptions Unsubscribe the given User from Notifications on the matching Subscribable entities. Scoped OAuth requires: `subscribers.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The entities to unsubscribe from.',
    ),
  ),
  'pagerduty_update_addon' =>
  array (
    'slug' => 'pagerduty_update_addon',
    'class' => 'PagerdutyUpdateAddon',
    'method' => 'PUT',
    'path' => '/addons/{id}',
    'operation_id' => 'updateAddon',
    'name' => 'Update an Add-on',
    'description' => 'Update an Add-on Update an existing Add-on. Addon\'s are pieces of functionality that developers can write to insert new functionality into PagerDuty\'s UI. Given a configuration containing a `src` parameter, that URL will be embedded in an `iframe` on a page that\'s available to users from a drop-down menu. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#add-ons) Scoped OAuth requires: `addons.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The Add-on to be updated.',
    ),
  ),
  'pagerduty_update_automation_action' =>
  array (
    'slug' => 'pagerduty_update_automation_action',
    'class' => 'PagerdutyUpdateAutomationAction',
    'method' => 'PUT',
    'path' => '/automation_actions/actions/{id}',
    'operation_id' => 'updateAutomationAction',
    'name' => 'Update an Automation Action',
    'description' => 'Update an Automation Action Updates an Automation Action',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_automation_actions_runner' =>
  array (
    'slug' => 'pagerduty_update_automation_actions_runner',
    'class' => 'PagerdutyUpdateAutomationActionsRunner',
    'method' => 'PUT',
    'path' => '/automation_actions/runners/{id}',
    'operation_id' => 'updateAutomationActionsRunner',
    'name' => 'Update an Automation Action runner',
    'description' => 'Update an Automation Action runner',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_business_service' =>
  array (
    'slug' => 'pagerduty_update_business_service',
    'class' => 'PagerdutyUpdateBusinessService',
    'method' => 'PUT',
    'path' => '/business_services/{id}',
    'operation_id' => 'updateBusinessService',
    'name' => 'Update a Business Service',
    'description' => 'Update a Business Service Update an existing Business Service. NOTE that this endpoint also accepts the PATCH verb. Business services model capabilities that span multiple technical services and that may be owned by several different teams. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#business-services) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_cache_var_on_global_orch' =>
  array (
    'slug' => 'pagerduty_update_cache_var_on_global_orch',
    'class' => 'PagerdutyUpdateCacheVarOnGlobalOrch',
    'method' => 'PUT',
    'path' => '/event_orchestrations/{id}/cache_variables/{cache_variable_id}',
    'operation_id' => 'updateCacheVarOnGlobalOrch',
    'name' => 'Update a Cache Variable for a Global Event Orchestration',
    'description' => 'Update a Cache Variable for a Global Event Orchestration. Cache Variables allow you to store event data on an Event Orchestration, which can then be used in Event Orchestration rules as part of conditions or actions. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'string',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_cache_var_on_service_orch' =>
  array (
    'slug' => 'pagerduty_update_cache_var_on_service_orch',
    'class' => 'PagerdutyUpdateCacheVarOnServiceOrch',
    'method' => 'PUT',
    'path' => '/event_orchestrations/services/{service_id}/cache_variables/{cache_variable_id}',
    'operation_id' => 'updateCacheVarOnServiceOrch',
    'name' => 'Update a Cache Variable for a Service Event Orchestration',
    'description' => 'Update a Cache Variable for a Service Event Orchestration. Cache Variables allow you to store event data on an Event Orchestration, which can then be used in Event Orchestration rules as part of conditions or actions. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'string',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_change_event' =>
  array (
    'slug' => 'pagerduty_update_change_event',
    'class' => 'PagerdutyUpdateChangeEvent',
    'method' => 'PUT',
    'path' => '/change_events/{id}',
    'operation_id' => 'updateChangeEvent',
    'name' => 'Update a Change Event',
    'description' => 'Update a Change Event Update an existing Change Event Scoped OAuth requires: `change_events.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The Change Event to be updated.',
    ),
  ),
  'pagerduty_update_custom_fields_field' =>
  array (
    'slug' => 'pagerduty_update_custom_fields_field',
    'class' => 'PagerdutyUpdateCustomFieldsField',
    'method' => 'PUT',
    'path' => '/incidents/custom_fields/{field_id}',
    'operation_id' => 'updateCustomFieldsField',
    'name' => 'Update a Field',
    'description' => 'Update a Field <!-- theme: warning --> > ### Deprecated > This endpoint is deprecated and only works for fields on the Base Incident Type. \\ > For more flexibility, we recommend using the Incident Types endpoint: \\ > [/incidents/types/{type_id_or_name}/custom_fields/{field_id}](openapiv3.json/paths/~1incidents~1types~1{type_id_or_name}~1custom_fields~1{field_id}/put) Update a Custom Field on the Base Incident Type. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_custom_fields_field_option' =>
  array (
    'slug' => 'pagerduty_update_custom_fields_field_option',
    'class' => 'PagerdutyUpdateCustomFieldsFieldOption',
    'method' => 'PUT',
    'path' => '/incidents/custom_fields/{field_id}/field_options/{field_option_id}',
    'operation_id' => 'updateCustomFieldsFieldOption',
    'name' => 'Update a Field Option',
    'description' => 'Update a Field Option <!-- theme: warning --> > ### Deprecated > This endpoint is deprecated and only works for fields on the Base Incident Type. \\ > For more flexibility, we recommend using the Incident Types endpoint: \\ > [/incidents/types/{type_id_or_name}/custom_fields/{field_id}/field_options/{field_option_id}](openapiv3.json/paths/~1incidents~1types~1{type_id_or_name}~1custom_fields~1{field_id}~1field_options~1{field_option_id}/put) Update a Field Option for a Custom Field on the Base Incident Type. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_custom_shift' =>
  array (
    'slug' => 'pagerduty_update_custom_shift',
    'class' => 'PagerdutyUpdateCustomShift',
    'method' => 'PUT',
    'path' => '/v3/schedules/{id}/custom_shifts/{custom_shift_id}',
    'operation_id' => 'updateCustomShift',
    'name' => 'Update a custom shift',
    'description' => 'Update a custom shift <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Update an existing custom shift. If the shift has already started, only `end_time` can be modified.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_escalation_policy' =>
  array (
    'slug' => 'pagerduty_update_escalation_policy',
    'class' => 'PagerdutyUpdateEscalationPolicy',
    'method' => 'PUT',
    'path' => '/escalation_policies/{id}',
    'operation_id' => 'updateEscalationPolicy',
    'name' => 'Update an escalation policy',
    'description' => 'Update an escalation policy Updates an existing escalation policy and rules. Escalation policies define which user should be alerted at which time. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#escalation-policies) Scoped OAuth requires: `escalation_policies.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The escalation policy to be updated.',
    ),
  ),
  'pagerduty_update_event' =>
  array (
    'slug' => 'pagerduty_update_event',
    'class' => 'PagerdutyUpdateEvent',
    'method' => 'PUT',
    'path' => '/v3/schedules/{id}/rotations/{rotation_id}/events/{event_id}',
    'operation_id' => 'updateEvent',
    'name' => 'Update an event',
    'description' => 'Update an event <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Update an existing event. **Restrictions based on event timing:** - **Past events** (effective_until in the past): Cannot be modified - **Active events** (currently producing shifts): Can only update `effective_until` - **Future events** (effective_since in the future): All fields can be updated',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_event_orchestration_feature_enablements' =>
  array (
    'slug' => 'pagerduty_update_event_orchestration_feature_enablements',
    'class' => 'PagerdutyUpdateEventOrchestrationFeatureEnablements',
    'method' => 'PUT',
    'path' => '/event_orchestrations/{id}/enablements/{feature_name}',
    'operation_id' => 'updateEventOrchestrationFeatureEnablements',
    'name' => 'Update an Enablement for an Event Orchestration',
    'description' => 'Update an Enablement for an Event Orchestration Update the feature enablement setting for a specific product addon on an Event Orchestration. This setting controls enabling or disabling the set of features contained within the addon. Currently, only `aiops` is supported as a valid feature enablement. **Warning conditions**: - If the account is not entitled to use AIOps features, the setting will be updated, but a warning will be returned. Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The feature enablement setting to apply.',
    ),
  ),
  'pagerduty_update_extension' =>
  array (
    'slug' => 'pagerduty_update_extension',
    'class' => 'PagerdutyUpdateExtension',
    'method' => 'PUT',
    'path' => '/extensions/{id}',
    'operation_id' => 'updateExtension',
    'name' => 'Update an extension',
    'description' => 'Update an extension Update an existing extension. Extensions are representations of Extension Schema objects that are attached to Services. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#extensions) Scoped OAuth requires: `extensions.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The extension to be updated.',
    ),
  ),
  'pagerduty_update_external_data_cache_var_data_on_global_orch' =>
  array (
    'slug' => 'pagerduty_update_external_data_cache_var_data_on_global_orch',
    'class' => 'PagerdutyUpdateExternalDataCacheVarDataOnGlobalOrch',
    'method' => 'PUT',
    'path' => '/event_orchestrations/{id}/cache_variables/{cache_variable_id}/data',
    'operation_id' => 'updateExternalDataCacheVarDataOnGlobalOrch',
    'name' => 'Update Data for an External Data Cache Variable on a Global Event Orchestration',
    'description' => 'Update Data for an External Data Cache Variable on a Global Event Orchestration Update data for an `external_data` type Cache Variable on a Global Event Orchestration Use External Data type Cache Variables to store string, number, or boolean values via a dedicated API endpoint. These stored values can then be used in conditions or actions in Event Orchestration rules. For more information see the [Knowledge Base](https://support.pagerduty.com/main/docs/event-orchestration-cache-variables) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'string',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_external_data_cache_var_data_on_service_orch' =>
  array (
    'slug' => 'pagerduty_update_external_data_cache_var_data_on_service_orch',
    'class' => 'PagerdutyUpdateExternalDataCacheVarDataOnServiceOrch',
    'method' => 'PUT',
    'path' => '/event_orchestrations/services/{service_id}/cache_variables/{cache_variable_id}/data',
    'operation_id' => 'updateExternalDataCacheVarDataOnServiceOrch',
    'name' => 'Update Data for an External Data Cache Variable on a Service Event Orchestration',
    'description' => 'Update Data for an External Data Cache Variable on a Service Event Orchestration Update the data for an `external_data` type Cache Variable on a Service Event Orchestration. Use External Data type Cache Variables to store string, number, or boolean values via a dedicated API endpoint. These stored values can then be used in conditions or actions in Event Orchestration rules. For more information see the [Knowledge Base](https://support.pagerduty.com/main/docs/event-orchestration-cache-variables) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'string',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_incident' =>
  array (
    'slug' => 'pagerduty_update_incident',
    'class' => 'PagerdutyUpdateIncident',
    'method' => 'PUT',
    'path' => '/incidents/{id}',
    'operation_id' => 'updateIncident',
    'name' => 'Update an incident',
    'description' => 'Update an incident Acknowledge, resolve, escalate or reassign an incident. An incident represents a problem or an issue that needs to be addressed and resolved. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_incident_alert' =>
  array (
    'slug' => 'pagerduty_update_incident_alert',
    'class' => 'PagerdutyUpdateIncidentAlert',
    'method' => 'PUT',
    'path' => '/incidents/{id}/alerts/{alert_id}',
    'operation_id' => 'updateIncidentAlert',
    'name' => 'Update an alert',
    'description' => 'Update an alert Resolve an alert or associate an alert with a new parent incident. An incident represents a problem or an issue that needs to be addressed and resolved. When a service sends an event to PagerDuty, an alert and corresponding incident is triggered in PagerDuty. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The parameters of the alert to update.',
    ),
  ),
  'pagerduty_update_incident_alerts' =>
  array (
    'slug' => 'pagerduty_update_incident_alerts',
    'class' => 'PagerdutyUpdateIncidentAlerts',
    'method' => 'PUT',
    'path' => '/incidents/{id}/alerts',
    'operation_id' => 'updateIncidentAlerts',
    'name' => 'Manage alerts',
    'description' => 'Manage alerts Resolve multiple alerts or associate them with different incidents. An incident represents a problem or an issue that needs to be addressed and resolved. An alert represents a digital signal that was emitted to PagerDuty by the monitoring systems that detected or identified the issue. A maximum of 250 alerts may be updated at a time. If more than this number of alerts are given, the API will respond with status 413 (Request Entity Too Large). For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_incident_note' =>
  array (
    'slug' => 'pagerduty_update_incident_note',
    'class' => 'PagerdutyUpdateIncidentNote',
    'method' => 'PUT',
    'path' => '/incidents/{id}/notes/{note_id}',
    'operation_id' => 'updateIncidentNote',
    'name' => 'Update a note on an incident',
    'description' => 'Update a note on an incident Update an existing note for the specified incident. An incident represents a problem or an issue that needs to be addressed and resolved. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_incident_type' =>
  array (
    'slug' => 'pagerduty_update_incident_type',
    'class' => 'PagerdutyUpdateIncidentType',
    'method' => 'PUT',
    'path' => '/incidents/types/{type_id_or_name}',
    'operation_id' => 'updateIncidentType',
    'name' => 'Update an Incident Type',
    'description' => 'Update an Incident Type. Incident Types are a feature which will allow customers to categorize incidents, such as a security incident, a major incident, or a fraud incident. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incident) Scoped OAuth requires: `incident_types.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_incident_type_custom_field' =>
  array (
    'slug' => 'pagerduty_update_incident_type_custom_field',
    'class' => 'PagerdutyUpdateIncidentTypeCustomField',
    'method' => 'PUT',
    'path' => '/incidents/types/{type_id_or_name}/custom_fields/{field_id}',
    'operation_id' => 'updateIncidentTypeCustomField',
    'name' => 'Update a Custom Field for an Incident Type',
    'description' => 'Update a Custom Field for an Incident Type Update a custom field for an incident type. Field Options can also be updated within the same call. Custom Fields (CF) are a feature which will allow customers to extend Incidents with their own custom data, to provide additional context and support features such as customized filtering, search and analytics. Custom Fields can be applied to different incident types. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_incident_type_custom_field_field_option' =>
  array (
    'slug' => 'pagerduty_update_incident_type_custom_field_field_option',
    'class' => 'PagerdutyUpdateIncidentTypeCustomFieldFieldOption',
    'method' => 'PUT',
    'path' => '/incidents/types/{type_id_or_name}/custom_fields/{field_id}/field_options/{field_option_id}',
    'operation_id' => 'updateIncidentTypeCustomFieldFieldOption',
    'name' => 'Update a Field Option for a Custom Field',
    'description' => 'Update a Field Option for a Custom Field Update a field option for a custom field. Custom Fields (CF) are a feature which will allow customers to extend Incidents with their own custom data, to provide additional context and support features such as customized filtering, search and analytics. Custom Fields can be applied to different incident types. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_incident_workflow_trigger' =>
  array (
    'slug' => 'pagerduty_update_incident_workflow_trigger',
    'class' => 'PagerdutyUpdateIncidentWorkflowTrigger',
    'method' => 'PUT',
    'path' => '/incident_workflows/triggers/{id}',
    'operation_id' => 'updateIncidentWorkflowTrigger',
    'name' => 'Update a Trigger',
    'description' => 'Update a Trigger Update an existing Incident Workflow Trigger Scoped OAuth requires: `incident_workflows.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_incidents' =>
  array (
    'slug' => 'pagerduty_update_incidents',
    'class' => 'PagerdutyUpdateIncidents',
    'method' => 'PUT',
    'path' => '/incidents',
    'operation_id' => 'updateIncidents',
    'name' => 'Manage incidents',
    'description' => 'Manage incidents Acknowledge, resolve, escalate or reassign one or more incidents. An incident represents a problem or an issue that needs to be addressed and resolved. A maximum of 250 incidents may be updated at a time. If more than this number of incidents are given, the API will respond with status 413 (Request Entity Too Large). For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#incidents) Scoped OAuth requires: `incidents.write` This API operation has operation specific rate limits. See the [Rate Limits](https://developer.pagerduty.com/docs/72d3b724589e3-rest-api-rate-limits) page for more information.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_log_entry_channel' =>
  array (
    'slug' => 'pagerduty_update_log_entry_channel',
    'class' => 'PagerdutyUpdateLogEntryChannel',
    'method' => 'PUT',
    'path' => '/log_entries/{id}/channel',
    'operation_id' => 'updateLogEntryChannel',
    'name' => 'Update log entry channel information.',
    'description' => 'Update log entry channel information. Update an existing incident log entry channel. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#log-entries) Scoped OAuth requires: `incidents.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The log entry channel to be updated.',
    ),
  ),
  'pagerduty_update_maintenance_window' =>
  array (
    'slug' => 'pagerduty_update_maintenance_window',
    'class' => 'PagerdutyUpdateMaintenanceWindow',
    'method' => 'PUT',
    'path' => '/maintenance_windows/{id}',
    'operation_id' => 'updateMaintenanceWindow',
    'name' => 'Update a maintenance window',
    'description' => 'Update a maintenance window Update an existing maintenance window. A Maintenance Window is used to temporarily disable one or more Services for a set period of time. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#maintenance-windows) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The maintenance window to be updated.',
    ),
  ),
  'pagerduty_update_oauth_client' =>
  array (
    'slug' => 'pagerduty_update_oauth_client',
    'class' => 'PagerdutyUpdateOauthClient',
    'method' => 'PUT',
    'path' => '/webhook_subscriptions/oauth_clients/{id}',
    'operation_id' => 'updateOauthClient',
    'name' => 'Update an OAuth client',
    'description' => 'Update an OAuth client Update an existing OAuth client. Any change will trigger token validation with the OAuth server. Requires admin or owner role permissions.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_orch_active_status' =>
  array (
    'slug' => 'pagerduty_update_orch_active_status',
    'class' => 'PagerdutyUpdateOrchActiveStatus',
    'method' => 'PUT',
    'path' => '/event_orchestrations/services/{service_id}/active',
    'operation_id' => 'updateOrchActiveStatus',
    'name' => 'Update the Service Orchestration active status for a Service',
    'description' => 'Update the Service Orchestration active status for a Service Update a Service Orchestration\'s active status. A Service Orchestration allows you to set an active status based on whether an event will be evaluated against a service orchestration path (true) or service ruleset (false). For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Update Service Orchestration\'s active status.',
    ),
  ),
  'pagerduty_update_orch_path_global' =>
  array (
    'slug' => 'pagerduty_update_orch_path_global',
    'class' => 'PagerdutyUpdateOrchPathGlobal',
    'method' => 'PUT',
    'path' => '/event_orchestrations/{id}/global',
    'operation_id' => 'updateOrchPathGlobal',
    'name' => 'Update the Global Orchestration for an Event Orchestration',
    'description' => 'Update the Global Orchestration for an Event Orchestration. Global Orchestration Rules allows you to create a set of Event Rules. These rules evaluate against all Events sent to an Event Orchestration. When a matching rule is found, it can modify and enhance the event and can route the event to another set of Global Rules within this Orchestration for further processing. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Update Global Orchestration rules. Omitted rules and rule details are deleted.',
    ),
  ),
  'pagerduty_update_orch_path_router' =>
  array (
    'slug' => 'pagerduty_update_orch_path_router',
    'class' => 'PagerdutyUpdateOrchPathRouter',
    'method' => 'PUT',
    'path' => '/event_orchestrations/{id}/router',
    'operation_id' => 'updateOrchPathRouter',
    'name' => 'Update the Router for an Event Orchestration',
    'description' => 'Update the Router for an Event Orchestration Update a Global Orchestration\'s Routing Rules. An Orchestration Router allows you to create a set of Event Rules. The Router evaluates Events you send to this Global Orchestration against each of its rules, one at a time, and routes the event to a specific Service based on the first rule that matches. If an event doesn\'t match any rules, it\'ll be sent to service specified in as the `catch_all` or the "Unrouted" Orchestration if no service is specified. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Updates to Orchestration Router details. Omitted rules and rule details are deleted.',
    ),
  ),
  'pagerduty_update_orch_path_service' =>
  array (
    'slug' => 'pagerduty_update_orch_path_service',
    'class' => 'PagerdutyUpdateOrchPathService',
    'method' => 'PUT',
    'path' => '/event_orchestrations/services/{service_id}',
    'operation_id' => 'updateOrchPathService',
    'name' => 'Update the Service Orchestration for a Service',
    'description' => 'Update the Service Orchestration for a Service Update a Service Orchestration. A Service Orchestration allows you to create a set of Event Rules. The Service Orchestration evaluates Events sent to this Service against each of its rules, beginning with the rules in the "start" set. When a matching rule is found, it can modify and enhance the event and can route the event to another set of rules within this Service Orchestration for further processing. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Update Service Orchestration rules. Omitted rules and rule details are deleted.',
    ),
  ),
  'pagerduty_update_orch_path_unrouted' =>
  array (
    'slug' => 'pagerduty_update_orch_path_unrouted',
    'class' => 'PagerdutyUpdateOrchPathUnrouted',
    'method' => 'PUT',
    'path' => '/event_orchestrations/{id}/unrouted',
    'operation_id' => 'updateOrchPathUnrouted',
    'name' => 'Update the Unrouted Orchestration for an Event Orchestration',
    'description' => 'Update the Unrouted Orchestration for an Event Orchestration Update a Global Event Orchestration\'s Rules for Unrouted events. An Unrouted Orchestration allows you to create a set of Event Rules that will be evaluated against all events that don\'t match any rules in the Global Orchestration\'s Router. Events that reach the Unrouted Orchestration will never be routed to a specific Service. The Unrouted Orchestration evaluates Events sent to it against each of its rules, beginning with the rules in the "start" set. When a matching rule is found, it can modify and enhance the event and can route the event to another set of rules within this Unrouted Orchestration for further processing. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'Updates to Unrouted Orchestration rules. Omitted rules and rule details are deleted.',
    ),
  ),
  'pagerduty_update_orchestration' =>
  array (
    'slug' => 'pagerduty_update_orchestration',
    'class' => 'PagerdutyUpdateOrchestration',
    'method' => 'PUT',
    'path' => '/event_orchestrations/{id}',
    'operation_id' => 'updateOrchestration',
    'name' => 'Update an Orchestration',
    'description' => 'Update an Orchestration Update a Global Event Orchestration. Global Event Orchestrations allow you define a set of Global Rules and Router Rules, so that when you ingest events using the Orchestration\'s Routing Key your events will have actions applied via the Global Rules & then routed to the correct Service by the Router Rules, based on the event\'s content. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => '',
    ),
  ),
  'pagerduty_update_orchestration_integration' =>
  array (
    'slug' => 'pagerduty_update_orchestration_integration',
    'class' => 'PagerdutyUpdateOrchestrationIntegration',
    'method' => 'PUT',
    'path' => '/event_orchestrations/{id}/integrations/{integration_id}',
    'operation_id' => 'updateOrchestrationIntegration',
    'name' => 'Update an Integration for an Event Orchestration',
    'description' => 'Update an Integration for an Event Orchestration Update an Integration associated with this Event Orchestrations. You can use the Routing Key from this Integration to send events to PagerDuty! For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#event-orchestrations) Scoped OAuth requires: `event_orchestrations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_override' =>
  array (
    'slug' => 'pagerduty_update_override',
    'class' => 'PagerdutyUpdateOverride',
    'method' => 'PUT',
    'path' => '/v3/schedules/{id}/overrides/{override_id}',
    'operation_id' => 'updateOverride',
    'name' => 'Update an override',
    'description' => 'Update an override <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Update an existing override.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_ruleset' =>
  array (
    'slug' => 'pagerduty_update_ruleset',
    'class' => 'PagerdutyUpdateRuleset',
    'method' => 'PUT',
    'path' => '/rulesets/{id}',
    'operation_id' => 'updateRuleset',
    'name' => 'Update a Ruleset',
    'description' => 'Update a Ruleset. <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Rulesets allow you to route events to an endpoint and create collections of Event Rules, which define sets of actions to take based on event content. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#rulesets) Scoped OAuth requires: `event_rules.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_ruleset_event_rule' =>
  array (
    'slug' => 'pagerduty_update_ruleset_event_rule',
    'class' => 'PagerdutyUpdateRulesetEventRule',
    'method' => 'PUT',
    'path' => '/rulesets/{id}/rules/{rule_id}',
    'operation_id' => 'updateRulesetEventRule',
    'name' => 'Update an Event Rule',
    'description' => 'Update an Event Rule. Note that the endpoint supports partial updates, so any number of the writable fields can be provided. <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Rulesets allow you to route events to an endpoint and create collections of Event Rules, which define sets of actions to take based on event content. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#rulesets) Note: Create and Update on rules will accept \'description\' or \'summary\' interchangeably as an extraction action target. Get and List on rules will always return \'summary\' as the target. If you are expecting \'description\' please change your automation code to expect \'summary\' instead. Scoped OAuth requires: `event_rules.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_schedule' =>
  array (
    'slug' => 'pagerduty_update_schedule',
    'class' => 'PagerdutyUpdateSchedule',
    'method' => 'PUT',
    'path' => '/schedules/{id}',
    'operation_id' => 'updateSchedule',
    'name' => 'Update a schedule',
    'description' => 'Update a schedule Update an existing on-call schedule. A Schedule determines the time periods that users are On-Call. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#schedules) Scoped OAuth requires: `schedules.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The schedule to be updated.',
    ),
  ),
  'pagerduty_update_schedule_v3' =>
  array (
    'slug' => 'pagerduty_update_schedule_v3',
    'class' => 'PagerdutyUpdateScheduleV3',
    'method' => 'PUT',
    'path' => '/v3/schedules/{id}',
    'operation_id' => 'updateScheduleV3',
    'name' => 'Update a schedule',
    'description' => 'Update a schedule <!-- theme: warning --> > ### Early Access > This API is in Early Access and may change at any time. You must pass the `X-EARLY-ACCESS: flexible-schedules-early-access` header on every request. <!-- theme: info --> > **Important note:** Shift-based schedules use the V3 API and are not compatible with V2 automations. **To create automations for Shift-Based Schedules, you need to:** > > 1. **Update your automations** to use the V3 API for all new shift-based schedules > 2. **Keep the V2 endpoint** for your existing schedules > > An upgrade tool for existing schedules is coming soon; your legacy schedules will keep working in the meantime. [Learn more](https://support.pagerduty.com/main/docs/shift-based-schedules-api-upgrade-examples). Update schedule metadata (name, description, time zone). All fields are optional - only provided fields are updated. To modify rotations or events, use their respective endpoints. **Rejected fields:** `rotations` and `escalation_policies` are not accepted and will result in a 400 error.',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_service' =>
  array (
    'slug' => 'pagerduty_update_service',
    'class' => 'PagerdutyUpdateService',
    'method' => 'PUT',
    'path' => '/services/{id}',
    'operation_id' => 'updateService',
    'name' => 'Update a service',
    'description' => 'Update a service Update an existing service. A service may represent an application, component, or team you wish to open incidents against. There is a limit of 100,000 open Incidents per Service. If the limit is reached and you disable `auto_resolve_timeout` (set to 0 or null), the API will respond with an error. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#services) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The service to be updated.',
    ),
  ),
  'pagerduty_update_service_custom_field' =>
  array (
    'slug' => 'pagerduty_update_service_custom_field',
    'class' => 'PagerdutyUpdateServiceCustomField',
    'method' => 'PUT',
    'path' => '/services/custom_fields/{field_id}',
    'operation_id' => 'updateServiceCustomField',
    'name' => 'Update a Field',
    'description' => 'Update a Field Update a Custom Field for Services. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_service_custom_field_option' =>
  array (
    'slug' => 'pagerduty_update_service_custom_field_option',
    'class' => 'PagerdutyUpdateServiceCustomFieldOption',
    'method' => 'PUT',
    'path' => '/services/custom_fields/{field_id}/field_options/{field_option_id}',
    'operation_id' => 'updateServiceCustomFieldOption',
    'name' => 'Update a Field Option',
    'description' => 'Update a Field Option Update a field option for a given field. Scoped OAuth requires: `custom_fields.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_service_custom_field_values' =>
  array (
    'slug' => 'pagerduty_update_service_custom_field_values',
    'class' => 'PagerdutyUpdateServiceCustomFieldValues',
    'method' => 'PUT',
    'path' => '/services/{id}/custom_fields/values',
    'operation_id' => 'updateServiceCustomFieldValues',
    'name' => 'Update Custom Field Values',
    'description' => 'Update Custom Field Values Set custom field values for a service. Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_service_event_rule' =>
  array (
    'slug' => 'pagerduty_update_service_event_rule',
    'class' => 'PagerdutyUpdateServiceEventRule',
    'method' => 'PUT',
    'path' => '/services/{id}/rules/{rule_id}',
    'operation_id' => 'updateServiceEventRule',
    'name' => 'Update an Event Rule on a Service',
    'description' => 'Update an Event Rule on a Service. Note that the endpoint supports partial updates, so any number of the writable fields can be provided. <!-- theme: warning --> > ### End-of-life > Rulesets and Event Rules will end-of-life soon. We highly recommend that you [migrate to Event Orchestration](https://support.pagerduty.com/docs/migrate-to-event-orchestration) as soon as possible so you can take advantage of the new functionality, such as improved UI, rule creation, APIs and Terraform support, advanced conditions, and rule nesting. Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_service_feature_enablement' =>
  array (
    'slug' => 'pagerduty_update_service_feature_enablement',
    'class' => 'PagerdutyUpdateServiceFeatureEnablement',
    'method' => 'PUT',
    'path' => '/services/{id}/enablements/{feature_name}',
    'operation_id' => 'updateServiceFeatureEnablement',
    'name' => 'Update an Enablement for a Service',
    'description' => 'Update an Enablement for a Service Update the feature enablement setting for a specific product addon on a service. This setting controls enabling or disabling the set of features contained within the addon. Currently, only `aiops` is supported as a valid feature enablement. **Warning conditions**: - If the account is not entitled to use AIOps features, the setting will be updated, but a warning will be returned. Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The feature enablement setting to apply.',
    ),
  ),
  'pagerduty_update_service_integration' =>
  array (
    'slug' => 'pagerduty_update_service_integration',
    'class' => 'PagerdutyUpdateServiceIntegration',
    'method' => 'PUT',
    'path' => '/services/{id}/integrations/{integration_id}',
    'operation_id' => 'updateServiceIntegration',
    'name' => 'Update an existing integration',
    'description' => 'Update an existing integration Update an integration belonging to a Service. A service may represent an application, component, or team you wish to open incidents against. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#services) Scoped OAuth requires: `services.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The integration to be updated',
    ),
  ),
  'pagerduty_update_session_configurations' =>
  array (
    'slug' => 'pagerduty_update_session_configurations',
    'class' => 'PagerdutyUpdateSessionConfigurations',
    'method' => 'PUT',
    'path' => '/session_configurations',
    'operation_id' => 'updateSessionConfigurations',
    'name' => 'Configure an account\'s session configurations',
    'description' => 'Configure an account\'s session configurations Creates or updates session configurations for a PagerDuty Account. The configurations will take effect immediately for new sessions, while existing sessions for the specified `types` are immediately revoked. Scoped OAuth requires: `session_configurations.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_sre_memory' =>
  array (
    'slug' => 'pagerduty_update_sre_memory',
    'class' => 'PagerdutyUpdateSreMemory',
    'method' => 'PUT',
    'path' => '/sre_agent/memories/{id}',
    'operation_id' => 'updateSreMemory',
    'name' => 'Update an SRE Agent memory',
    'description' => 'Update an SRE Agent memory Update an existing SRE Agent memory. Scoped OAuth requires: `sre_agent.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The SRE Agent memory to be updated.',
    ),
  ),
  'pagerduty_update_standard' =>
  array (
    'slug' => 'pagerduty_update_standard',
    'class' => 'PagerdutyUpdateStandard',
    'method' => 'PUT',
    'path' => '/standards/{id}',
    'operation_id' => 'updateStandard',
    'name' => 'Update a standard',
    'description' => 'Update a standard Updates a standard Scoped OAuth requires: `standards.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_status_page_post' =>
  array (
    'slug' => 'pagerduty_update_status_page_post',
    'class' => 'PagerdutyUpdateStatusPagePost',
    'method' => 'PUT',
    'path' => '/status_pages/{id}/posts/{post_id}',
    'operation_id' => 'updateStatusPagePost',
    'name' => 'Update a Status Page Post',
    'description' => 'Update a Status Page Post Update a Post for a Status Page by Status Page ID. Scoped OAuth requires: `status_pages.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_status_page_post_update' =>
  array (
    'slug' => 'pagerduty_update_status_page_post_update',
    'class' => 'PagerdutyUpdateStatusPagePostUpdate',
    'method' => 'PUT',
    'path' => '/status_pages/{id}/posts/{post_id}/post_updates/{post_update_id}',
    'operation_id' => 'updateStatusPagePostUpdate',
    'name' => 'Update a Status Page Post Update',
    'description' => 'Update a Status Page Post Update Update a Post Update for a Post by Post ID and Post Update ID. Scoped OAuth requires: `status_pages.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_team' =>
  array (
    'slug' => 'pagerduty_update_team',
    'class' => 'PagerdutyUpdateTeam',
    'method' => 'PUT',
    'path' => '/teams/{id}',
    'operation_id' => 'updateTeam',
    'name' => 'Update a team',
    'description' => 'Update a team Update an existing team. A team is a collection of Users and Escalation Policies that represent a group of people within an organization. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#teams) Scoped OAuth requires: `teams.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The team to be updated.',
    ),
  ),
  'pagerduty_update_team_escalation_policy' =>
  array (
    'slug' => 'pagerduty_update_team_escalation_policy',
    'class' => 'PagerdutyUpdateTeamEscalationPolicy',
    'method' => 'PUT',
    'path' => '/teams/{id}/escalation_policies/{escalation_policy_id}',
    'operation_id' => 'updateTeamEscalationPolicy',
    'name' => 'Add an escalation policy to a team',
    'description' => 'Add an escalation policy to a team. A team is a collection of Users and Escalation Policies that represent a group of people within an organization. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#teams) Scoped OAuth requires: `teams.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'pagerduty_update_team_user' =>
  array (
    'slug' => 'pagerduty_update_team_user',
    'class' => 'PagerdutyUpdateTeamUser',
    'method' => 'PUT',
    'path' => '/teams/{id}/users/{user_id}',
    'operation_id' => 'updateTeamUser',
    'name' => 'Add a user to a team',
    'description' => 'Add a user to a team. Attempting to add a user with the `read_only_user` role will return a 400 error. A team is a collection of Users and Escalation Policies that represent a group of people within an organization. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#teams) Scoped OAuth requires: `teams.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The role of the user on the team.',
    ),
  ),
  'pagerduty_update_template' =>
  array (
    'slug' => 'pagerduty_update_template',
    'class' => 'PagerdutyUpdateTemplate',
    'method' => 'PUT',
    'path' => '/templates/{id}',
    'operation_id' => 'updateTemplate',
    'name' => 'Update a template',
    'description' => 'Update a template Update an existing template Scoped OAuth requires: `templates.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_user' =>
  array (
    'slug' => 'pagerduty_update_user',
    'class' => 'PagerdutyUpdateUser',
    'method' => 'PUT',
    'path' => '/users/{id}',
    'operation_id' => 'updateUser',
    'name' => 'Update a user',
    'description' => 'Update a user Update an existing user. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The user to be updated.',
    ),
  ),
  'pagerduty_update_user_contact_method' =>
  array (
    'slug' => 'pagerduty_update_user_contact_method',
    'class' => 'PagerdutyUpdateUserContactMethod',
    'method' => 'PUT',
    'path' => '/users/{id}/contact_methods/{contact_method_id}',
    'operation_id' => 'updateUserContactMethod',
    'name' => 'Update a user\'s contact method',
    'description' => 'Update a user\'s contact method Update a User\'s contact method. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users:contact_methods.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The user\'s contact method to be updated.',
    ),
  ),
  'pagerduty_update_user_handoff_notification' =>
  array (
    'slug' => 'pagerduty_update_user_handoff_notification',
    'class' => 'PagerdutyUpdateUserHandoffNotification',
    'method' => 'PUT',
    'path' => '/users/{id}/oncall_handoff_notification_rules/{oncall_handoff_notification_rule_id}',
    'operation_id' => 'updateUserHandoffNotification',
    'name' => 'Update a User\'s Handoff Notification Rule',
    'description' => 'Update a User\'s Handoff Notification Rule. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The User\'s Handoff Notification Rule to be updated.',
    ),
  ),
  'pagerduty_update_user_notification_rule' =>
  array (
    'slug' => 'pagerduty_update_user_notification_rule',
    'class' => 'PagerdutyUpdateUserNotificationRule',
    'method' => 'PUT',
    'path' => '/users/{id}/notification_rules/{notification_rule_id}',
    'operation_id' => 'updateUserNotificationRule',
    'name' => 'Update a user\'s notification rule',
    'description' => 'Update a user\'s notification rule. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users:contact_methods.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The user\'s notification rule to be updated.',
    ),
  ),
  'pagerduty_update_user_status_update_notification_rule' =>
  array (
    'slug' => 'pagerduty_update_user_status_update_notification_rule',
    'class' => 'PagerdutyUpdateUserStatusUpdateNotificationRule',
    'method' => 'PUT',
    'path' => '/users/{id}/status_update_notification_rules/{status_update_notification_rule_id}',
    'operation_id' => 'updateUserStatusUpdateNotificationRule',
    'name' => 'Update a user\'s status update notification rule',
    'description' => 'Update a user\'s status update notification rule. Users are members of a PagerDuty account that have the ability to interact with Incidents and other data on the account. For more information see the [API Concepts Document](../../api-reference/a47605517c19a-api-concepts#users) Scoped OAuth requires: `users.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'The user\'s status update notification rule to be updated.',
    ),
  ),
  'pagerduty_update_webhook_subscription' =>
  array (
    'slug' => 'pagerduty_update_webhook_subscription',
    'class' => 'PagerdutyUpdateWebhookSubscription',
    'method' => 'PUT',
    'path' => '/webhook_subscriptions/{id}',
    'operation_id' => 'updateWebhookSubscription',
    'name' => 'Update a webhook subscription',
    'description' => 'Update a webhook subscription Updates an existing webhook subscription. Only the fields being updated need to be included on the request. This operation does not support updating the `delivery_method` of the webhook subscription. Scoped OAuth requires: `webhook_subscriptions.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'object',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
  'pagerduty_update_workflow_integration_connection' =>
  array (
    'slug' => 'pagerduty_update_workflow_integration_connection',
    'class' => 'PagerdutyUpdateWorkflowIntegrationConnection',
    'method' => 'PATCH',
    'path' => '/workflows/integrations/{integration_id}/connections/{id}',
    'operation_id' => 'updateWorkflowIntegrationConnection',
    'name' => 'Update Workflow Integration Connection',
    'description' => 'Update Workflow Integration Connection Update an existing Workflow Integration Connection. Scoped OAuth requires: `workflow_integrations:connections.write`',
    'type' => 'write',
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => false,
      'schema_type' => 'string',
      'description' => 'JSON request body for the PagerDuty API operation.',
    ),
  ),
);
    }
}
