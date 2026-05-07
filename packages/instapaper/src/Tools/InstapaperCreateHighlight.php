<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Create an Instapaper bookmark highlight. */
class InstapaperCreateHighlight extends AbstractInstapaperTool { protected const NAME = 'instapaper_create_highlight'; protected const DESCRIPTION = 'Create a highlight for an Instapaper bookmark with text, position, and optional note fields.'; protected const OPERATION = 'create_highlight'; protected const REQUIRED = ['bookmark_id', 'text']; }
