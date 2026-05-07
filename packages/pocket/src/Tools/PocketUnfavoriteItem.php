<?php
namespace OpenCompany\Integrations\Pocket\Tools;
/** Unfavorite a Pocket item. */
class PocketUnfavoriteItem extends AbstractPocketActionTool { protected const NAME = 'pocket_unfavorite_item'; protected const DESCRIPTION = 'Remove favorite status from a Pocket item by item_id.'; protected const ACTION = 'unfavorite'; }
