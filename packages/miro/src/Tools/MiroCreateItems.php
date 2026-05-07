<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Adds different types of items to a board. You can add up to 20 items of the same or different type per create call. For example, you can create 3 shape items, 4 card items, and 5 sticky notes in one create call. The bulk create operation is transactional. If any item's create operation fails, the create operation for all the remaining items also fails, and none of the items will be created. To try out this API in our documentation: 1. In the **BODY PARAMS** section, scroll down until you see **ADD OBJECT** (Figure 1). Figure 1. Add object user interface in readme 2. Click **ADD OBJECT**, and then select or enter the appropriate values for parameters of the item that you want to add. 3. Repeat steps 1 and 2 for each item that you want to add. Required scope boards:write Rate limiting Level 2 per item. For example, if you want to create one sticky note, one card, and one shape item in one call, the rate limiting applicable will be 300 credits. This is because create item calls take Level 2 rate limiting of 100 credits each, 100 for sticky note, 100 for card, and 100 for shape item..
 *
 * Maps to the official Miro endpoint POST /v2/boards/{board_id}/items/bulk.
 */
class MiroCreateItems extends AbstractMiroTool
{
    protected const NAME = 'miro_create_items';
    protected const DESCRIPTION = 'Adds different types of items to a board. You can add up to 20 items of the same or different type per create call. For example, you can create 3 shape items, 4 card items, and 5 sticky notes in one create call. The bulk create operation is transactional. If any item\'s create operation fails, the create operation for all the remaining items also fails, and none of the items will be created. To try out this API in our documentation: 1. In the **BODY PARAMS** section, scroll down until you see **ADD OBJECT** (Figure 1). Figure 1. Add object user interface in readme 2. Click **ADD OBJECT**, and then select or enter the appropriate values for parameters of the item that you want to add. 3. Repeat steps 1 and 2 for each item that you want to add. Required scope boards:write Rate limiting Level 2 per item. For example, if you want to create one sticky note, one card, and one shape item in one call, the rate limiting applicable will be 300 credits. This is because create item calls take Level 2 rate limiting of 100 credits each, 100 for sticky note, 100 for card, and 100 for shape item.

Official Miro endpoint: POST /v2/boards/{board_id}/items/bulk.';
    protected const PARAMETERS = array (
      'board_id' => array (
        'type' => 'string',
        'description' => 'board_id path parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/boards/{board_id}/items/bulk';
    protected const PATH_PARAMS = array (
      'board_id' => 'board_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
