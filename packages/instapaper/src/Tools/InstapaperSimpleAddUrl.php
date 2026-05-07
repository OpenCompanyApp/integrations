<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Add a URL through the Instapaper Simple API. */
class InstapaperSimpleAddUrl extends AbstractInstapaperTool { protected const NAME = 'instapaper_simple_add_url'; protected const DESCRIPTION = 'Save a URL through the Instapaper Simple API with optional title and selection fields.'; protected const OPERATION = 'simple_add_url'; protected const REQUIRED = ['url']; }
