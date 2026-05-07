<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves the list of users in your organization. Note: The API returns users that are members in the organization, it does not return users that are added in the organization as guests..
 *
 * Maps to the official Miro endpoint GET /Users.
 */
class MiroListUsers extends AbstractMiroTool
{
    protected const NAME = 'miro_list_users';
    protected const DESCRIPTION = 'Retrieves the list of users in your organization. Note: The API returns users that are members in the organization, it does not return users that are added in the organization as guests.

Official Miro endpoint: GET /Users.';
    protected const PARAMETERS = array (
      'attributes' => array (
        'type' => 'string',
        'description' => 'A comma-separated list of attribute names to return in the response. Example attributes: id, userName, displayName, name, userType, active, emails, photos, groups, roles. You can also retrieve attributes within complex attributes, for Example: emails.value. The API also supports sorting and the filter parameter.',
        'required' => false,
      ),
      'filter' => array (
        'type' => 'string',
        'description' => 'You can request a subset of resources by specifying the filter query parameter containing a filter expression. Attribute names and attribute operators used in filters are not case sensitive. The filter parameter must contain at least one valid expression. Each expression must contain an attribute name followed by an attribute operator and an optional value. eq = equal ne = not equal co = contains sw = starts with ew = ends with pr = preset (has value) gt = greater than ge = greater than or equal to lt = less than le = less than or equal to and = Logical "and" or = Logical "or" not = "Not" function () = Precedence grouping The value must be passed within parenthesis. Example filters: For fetching users with user name as user@miro.com: userName eq "user@miro.com" For fetching all active users in the organization: active eq true For fetching users with "user" in their displayName: displayName co "user" For fetching users that are member of a specific group (team): groups.value eq "3458764577585056871" For fetching users that are not of userType Full: userType ne "Full"',
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
        'description' => 'Specifies the attribute whose value will be used to order the response. Example: sortBy=userName, sortBy=emails.value',
        'required' => false,
      ),
      'sort_order' => array (
        'type' => 'string',
        'description' => 'Defines the order in which the sortBy parameter is applied. Example: sortOrder=ascending',
        'required' => false,
        'enum' => array (
          'ascending',
          'descending',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/Users';
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
