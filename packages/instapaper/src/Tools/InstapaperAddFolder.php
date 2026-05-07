<?php
namespace OpenCompany\Integrations\Instapaper\Tools;
/** Add an Instapaper folder. */
class InstapaperAddFolder extends AbstractInstapaperTool { protected const NAME = 'instapaper_add_folder'; protected const DESCRIPTION = 'Create an Instapaper folder by title.'; protected const OPERATION = 'add_folder'; protected const REQUIRED = ['title']; }
