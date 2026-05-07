<?php
namespace OpenCompany\Integrations\Readwise\Tools;
/** Delete a tag from a Readwise highlight. */
class ReadwiseDeleteHighlightTag extends AbstractReadwiseTool { protected const NAME = 'readwise_delete_highlight_tag'; protected const DESCRIPTION = 'Delete a tag from a Readwise highlight.'; protected const OPERATION = 'delete_highlight_tag'; protected const REQUIRED = ['highlight_id', 'tag_id']; }
