<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Create Readwise highlights. */
class ReadwiseCreateHighlights extends AbstractReadwiseTool { protected const NAME = 'readwise_create_highlights'; protected const DESCRIPTION = 'Create one or more highlights in Readwise.'; protected const OPERATION = 'create_highlights'; protected const REQUIRED = ['highlights']; }
