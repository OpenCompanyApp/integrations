<?php
namespace OpenCompany\Integrations\Pocket\Tools;
/** Save a URL to Pocket. */
class PocketAddItem extends AbstractPocketTool { protected const NAME = 'pocket_add_item'; protected const DESCRIPTION = 'Save one URL to Pocket with optional title, tags, tweet_id, and time fields.'; protected const METHOD = 'add'; protected const REQUIRED = ['url']; }
