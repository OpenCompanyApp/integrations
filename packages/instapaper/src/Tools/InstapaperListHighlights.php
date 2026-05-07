<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** List highlights for an Instapaper bookmark. */
class InstapaperListHighlights extends AbstractInstapaperTool { protected const NAME = 'instapaper_list_highlights'; protected const DESCRIPTION = 'List Instapaper highlights for a bookmark_id.'; protected const OPERATION = 'list_highlights'; protected const REQUIRED = ['bookmark_id']; }
