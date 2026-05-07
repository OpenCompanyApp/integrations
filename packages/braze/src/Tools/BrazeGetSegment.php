<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Get Braze segment details.
 */
class BrazeGetSegment extends AbstractBrazeTool
{
    protected array $parameters = array (
  'segment_id' =>
  array (
    'type' => 'string',
    'description' => 'Segment ID.',
    'required' => true,
  ),
);

    protected array $required = array (
  0 => 'segment_id',
);

    protected array $queryParams = array (
  0 => 'segment_id',
);

    protected array $bodyParams = array (
);

    protected string $method = 'GET';

    protected string $path = '/segments/details';

    protected string $toolName = 'braze_get_segment';

    protected string $toolDescription = 'Get Braze segment details.';
}