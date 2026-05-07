<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Delete a Readwise highlight. */
class ReadwiseDeleteHighlight extends AbstractReadwiseTool { protected const NAME = 'readwise_delete_highlight'; protected const DESCRIPTION = 'Delete a Readwise highlight.'; protected const OPERATION = 'delete_highlight'; protected const REQUIRED = ['highlight_id']; }
