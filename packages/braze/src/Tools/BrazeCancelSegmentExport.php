<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Cancel user exports by segment.
 */
class BrazeCancelSegmentExport extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Segment export cancel payload.',
  ),
);

    protected array $required = array (
);

    protected array $queryParams = array (
);

    protected array $bodyParams = array (
  0 => 'payload',
);

    protected string $method = 'POST';

    protected string $path = '/export/segment/cancel';

    protected string $toolName = 'braze_cancel_segment_export';

    protected string $toolDescription = 'Cancel user exports by segment.';
}
