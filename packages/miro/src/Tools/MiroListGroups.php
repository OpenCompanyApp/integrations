<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves the list of groups (teams) in the organization. Note: Along with groups (teams), the users that are part of those groups (teams) are also retrieved. Only users that have member role in the organization are fetched..
 *
 * Maps to the official Miro endpoint GET /Groups.
 */
class MiroListGroups extends AbstractMiroTool
{
    protected const NAME = 'miro_list_groups';
    protected const DESCRIPTION = 'Retrieves the list of groups (teams) in the organization. Note: Along with groups (teams), the users that are part of those groups (teams) are also retrieved. Only users that have member role in the organization are fetched.

Official Miro endpoint: GET /Groups.';
    protected const PARAMETERS = array (
      'attributes' => array (
        'type' => 'string',
        'description' => 'A comma-separated list of attribute names to return in the response. Example attributes: id,displayName Note: It is also possible to fetch attributes within complex attributes, for Example: members.display.',
        'required' => false,
      ),
      'filter' => array (
        'type' => 'string',
        'description' => 'You can request a subset of resources by specifying the filter query parameter containing a filter expression. Attribute names and attribute operators used in filters are not case sensitive. The filter parameter must contain at least one valid expression. Each expression must contain an attribute name followed by an attribute operator and an optional value. eq = equal ne = not equal co = contains sw = starts with ew = ends with pr = preset (has value) gt = greater than ge = greater than or equal to lt = less than le = less than or equal to and = Logical "and" or = Logical "or" not = "Not" function () = Precedence grouping The value must be passed within parenthesis. For Example: displayName eq "Product Team" will fetch information related to team matching the display name "Product Team". Note: Filtering on complex attributes is not supported',
        'required' => false,
      ),
      'start_index' => array (
        'type' => 'integer',
        'description' => 'Use startIndex in combination with count query parameters to receive paginated results. start index is 1-based. Example: startIndex=1',
        'required' => false,
      ),
      'count' => array (
        'type' => 'integer',
        'description' => 'Specifies the maximum number of query results per page. Use count in combination with startIndex query parameters to receive paginated results. The count query parameter is set to 100 by default and the maximum value allowed for this parameter is 1000. Example: count=12',
        'required' => false,
      ),
      'sort_by' => array (
        'type' => 'string',
        'description' => 'Specifies the attribute whose value will be used to order the response. Example sortBy=displayName',
        'required' => false,
      ),
      'sort_order' => array (
        'type' => 'string',
        'description' => 'Defines the order in which the \'sortBy\' parameter is applied. Example: sortOrder=ascending',
        'required' => false,
        'enum' => array (
          'ascending',
          'descending',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/Groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'attributes' => 'attributes',
      'filter' => 'filter',
      'startIndex' => 'start_index',
      'count' => 'count',
      'sortBy' => 'sort_by',
      'sortOrder' => 'sort_order',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
