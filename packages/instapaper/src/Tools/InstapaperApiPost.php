<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Execute a safe relative Instapaper Full API POST call. */
class InstapaperApiPost extends AbstractInstapaperRawTool { protected const NAME = 'instapaper_api_post'; protected const DESCRIPTION = 'Call a safe relative Instapaper Full API POST path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiPost'; }
