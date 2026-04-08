# Braze Integration

## Tools

### braze_list_campaigns
List marketing campaigns from Braze with pagination.

**Parameters:**
- `page` (integer, optional): Page number, 0-indexed. Default: 0.
- `limit` (integer, optional): Results per page, max 100. Default: 100.

### braze_get_campaign
Get details for a specific campaign.

**Parameters:**
- `campaign_id` (string, required): The campaign identifier.

### braze_list_canvases
List canvases (multi-step journeys) with pagination.

**Parameters:**
- `page` (integer, optional): Page number, 0-indexed. Default: 0.
- `limit` (integer, optional): Results per page, max 100. Default: 100.

### braze_get_canvas
Get details for a specific canvas.

**Parameters:**
- `canvas_id` (string, required): The canvas identifier.

### braze_list_users
Export users from Braze by segment or external IDs.

**Parameters:**
- `external_ids` (array, optional): External user IDs to look up.
- `segment_id` (string, optional): Segment ID to export users from.
- `limit` (integer, optional): Max users to return, max 5000. Default: 50.

### braze_get_user
Get a single user profile by external ID.

**Parameters:**
- `external_ids` (array, required): Array with one or more external user IDs.

### braze_get_current_user
Get the current authenticated Braze user profile. No parameters required.

## Configuration

Requires `api_key` (Bearer token) and optional `url` (default: `https://rest.iad-01.braze.com`).
