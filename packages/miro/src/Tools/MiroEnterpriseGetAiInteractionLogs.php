<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves AI interaction logs for your organization. AI interaction logs capture user interactions with AI features in Miro. You can retrieve results for a specific time period. You can also filter results based on object IDs and the emails of users who interacted with AI features. Additionally, results can be paginated for easier viewing and processing. Required scope aiinteractionlogs:read Rate limiting Level 4 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/ai-interaction-logs.
 */
class MiroEnterpriseGetAiInteractionLogs extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_get_ai_interaction_logs';
    protected const DESCRIPTION = 'Retrieves AI interaction logs for your organization. AI interaction logs capture user interactions with AI features in Miro. You can retrieve results for a specific time period. You can also filter results based on object IDs and the emails of users who interacted with AI features. Additionally, results can be paginated for easier viewing and processing. Required scope aiinteractionlogs:read Rate limiting Level 4 Enterprise Guard only This API is available only for Enterprise plan users with the Enterprise Guard add-on.

Official Miro endpoint: GET /v2/orgs/{org_id}/ai-interaction-logs.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier of the organization.',
        'required' => true,
      ),
      'object_ids' => array (
        'type' => 'array',
        'description' => 'List of object IDs used to retrieve AI interaction logs. Currently, supported object types include board IDs and organization IDs. You can obtain object IDs from the response of this endpoint (the object.id field), from other Platform API endpoints (for example, [Get boards API](https://developers.miro.com/reference/get-boards)), or from Miro UI URLs (board ID and organization ID from the URLs).',
        'required' => false,
      ),
      'emails' => array (
        'type' => 'array',
        'description' => 'Filters AI interaction logs using a list of user emails. Only AI interactions associated with the provided emails will be included in the response.',
        'required' => false,
      ),
      'from' => array (
        'type' => 'string',
        'description' => 'Start date and time of the time range used to filter AI interaction logs. Only interactions that were stored within the specified from - to time range are returned. Format: UTC, adheres to [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601), includes a [trailing Z offset](https://en.wikipedia.org/wiki/ISO_8601#Coordinated_Universal_Time_(UTC)).',
        'required' => true,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'End date and time of the time range used to filter AI interaction logs. Only interactions that were stored within the specified from - to time range are returned. Format: UTC, adheres to [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601), includes a [trailing Z offset](https://en.wikipedia.org/wiki/ISO_8601#Coordinated_Universal_Time_(UTC)).',
        'required' => true,
      ),
      'cursor' => array (
        'type' => 'string',
        'description' => 'A cursor-paginated method returns a portion of the total set of results based on the limit specified and a cursor that points to the next portion of the results. To retrieve the next portion of the collection, set the cursor parameter equal to the cursor value you received in the response of the previous request.',
        'required' => false,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'The maximum number of results to return per call. If the number of logs in the response is greater than the limit specified, the response returns the cursor parameter with a value.',
        'required' => false,
      ),
      'sorting' => array (
        'type' => 'string',
        'description' => 'Sort order in which you want to view the result set based on the interaction date. To sort by an ascending date, specify `asc`. To sort by a descending date, specify `desc`.',
        'required' => false,
        'enum' => array (
          'asc',
          'desc',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/ai-interaction-logs';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
    );
    protected const QUERY_PARAMS = array (
      'object_ids' => 'object_ids',
      'emails' => 'emails',
      'from' => 'from',
      'to' => 'to',
      'cursor' => 'cursor',
      'limit' => 'limit',
      'sorting' => 'sorting',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
