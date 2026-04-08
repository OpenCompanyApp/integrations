# Canva Integration

## Tools

### canva_list_designs

List designs the user has access to in Canva.

**Parameters:**
- `limit` (integer, optional): Maximum number of designs to return (1–100, default 50).
- `continuation` (string, optional): Cursor for pagination — pass the continuation token from a previous response.
- `query` (string, optional): Search query to filter designs by title.
- `type` (string, optional): Filter by design type (e.g., "presentation", "poster", "social_media", "video", "document").

**Returns:** Array of design objects with titles and IDs.

---

### canva_get_design

Get details of a specific Canva design.

**Parameters:**
- `design_id` (string, required): The ID of the design to retrieve.

**Returns:** Design object with title, type, dimensions, and URLs.

---

### canva_create_design

Create a new design in Canva.

**Parameters:**
- `title` (string, required): The title for the new design.
- `type` (string, optional): Design type (e.g., "presentation", "poster", "social_media", "video", "document").
- `width` (integer, optional): Width in pixels.
- `height` (integer, optional): Height in pixels.

**Returns:** Created design object with ID and edit URL.

---

### canva_list_folders

List folders the user has access to in Canva.

**Parameters:**
- `limit` (integer, optional): Maximum number of folders to return (1–100, default 50).
- `continuation` (string, optional): Cursor for pagination.

**Returns:** Array of folder objects with names and IDs.

---

### canva_get_folder

Get details of a specific Canva folder.

**Parameters:**
- `folder_id` (string, required): The ID of the folder to retrieve.

**Returns:** Folder object with name and contained items.

---

### canva_upload_asset

Upload an asset to Canva from a URL.

**Parameters:**
- `file_url` (string, required): The URL of the file to upload (must be publicly accessible).
- `name` (string, required): The name for the uploaded asset.
- `folder_id` (string, optional): Folder ID to upload the asset into.

**Returns:** Uploaded asset object with ID and metadata.

---

### canva_get_current_user

Get the authenticated Canva user's profile.

**Parameters:** None.

**Returns:** User object with display name and user ID.
