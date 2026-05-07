<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Update a Readwise highlight. */
class ReadwiseUpdateHighlight extends AbstractReadwiseTool { protected const NAME = 'readwise_update_highlight'; protected const DESCRIPTION = 'Update a Readwise highlight.'; protected const OPERATION = 'update_highlight'; protected const REQUIRED = ['highlight_id']; }
