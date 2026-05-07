<?php

namespace OpenCompany\Integrations\Samsara\Tools;

/**
 * Call a safe relative Samsara API path with GET.
 */
class SamsaraApiGet extends AbstractSamsaraEndpointTool
{
    protected const TOOL_NAME = 'samsara_api_get';
    protected const TOOL_DESCRIPTION = 'Call a safe relative Samsara API path with GET. Official Samsara endpoint: GET {path}.';
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_KEYS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'after',
  1 => 'limit',
  2 => 'types',
  3 => 'startTime',
  4 => 'endTime',
  5 => 'time',
  6 => 'tagIds',
  7 => 'parentTagIds',
  8 => 'vehicleIds',
  9 => 'driverIds',
  10 => 'trailerIds',
  11 => 'equipmentIds',
  12 => 'include',
  13 => 'includeExternalIds',
  14 => 'createdAfterTime',
  15 => 'createdBeforeTime',
  16 => 'updatedAfterTime',
  17 => 'updatedBeforeTime',
  18 => 'status',
  19 => 'sort',
  20 => 'addressIds',
  21 => 'ids',
);
    protected const PARAMETERS = array (
  'path' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Relative Samsara API path, for example /fleet/vehicles.',
  ),
  'after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: after.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: limit.',
  ),
  'types' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: types.',
  ),
  'startTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: startTime.',
  ),
  'endTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: endTime.',
  ),
  'time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: time.',
  ),
  'tagIds' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: tagIds.',
  ),
  'parentTagIds' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: parentTagIds.',
  ),
  'vehicleIds' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: vehicleIds.',
  ),
  'driverIds' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: driverIds.',
  ),
  'trailerIds' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: trailerIds.',
  ),
  'equipmentIds' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: equipmentIds.',
  ),
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: include.',
  ),
  'includeExternalIds' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: includeExternalIds.',
  ),
  'createdAfterTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: createdAfterTime.',
  ),
  'createdBeforeTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: createdBeforeTime.',
  ),
  'updatedAfterTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: updatedAfterTime.',
  ),
  'updatedBeforeTime' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: updatedBeforeTime.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: status.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: sort.',
  ),
  'addressIds' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: addressIds.',
  ),
  'ids' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Samsara query parameter: ids.',
  ),
  'params' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Additional Samsara query parameters.',
  ),
);
    protected const DYNAMIC_PATH = true;
}
