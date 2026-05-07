<?php

namespace OpenCompany\Integrations\Braze\Tools;

/**
 * Upload an asset to the Braze media library.
 */
class BrazeUploadMediaAsset extends AbstractBrazeTool
{
    protected array $parameters = array (
  'payload' =>
  array (
    'type' => 'object',
    'description' => 'Media asset payload.',
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

    protected string $path = '/media_library/create';

    protected string $toolName = 'braze_upload_media_asset';

    protected string $toolDescription = 'Upload an asset to the Braze media library.';
}
