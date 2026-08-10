# Microsoft Power BI Integration

Tools for interacting with the Microsoft Power BI REST API.

The namespace is `powerbi`. Use workspace IDs returned by
`powerbi_list_workspaces` when querying workspace-scoped datasets and reports.
The Power BI REST API does not expose a general current-user profile endpoint in
this package; credential checks use a lightweight workspace-list probe.

## Tools

### powerbi_list_workspaces
List Power BI workspaces (groups) the authenticated user has access to.

**Parameters:**
- `top` (integer, optional): Maximum number of workspaces to return. Default: 100.

**Returns:** Array of workspace objects with `id`, `name`, `isReadOnly`, `isOnDedicatedCapacity`, etc.

---

### powerbi_get_workspace
Get details for a specific Power BI workspace by its ID.

**Parameters:**
- `id` (string, required): The workspace (group) ID (a GUID).

**Returns:** Workspace object with full metadata.

---

### powerbi_list_datasets
List datasets within a Power BI workspace.

**Parameters:**
- `workspace_id` (string, required): The workspace (group) ID (a GUID).

**Returns:** Array of dataset objects with `id`, `name`, `webUrl`, `addRowsAPIEnabled`, `isRefreshable`, etc.

---

### powerbi_get_dataset
Get details for a specific dataset within a workspace.

**Parameters:**
- `workspace_id` (string, required): The workspace (group) ID (a GUID).
- `dataset_id` (string, required): The dataset ID (a GUID).

**Returns:** Dataset object with schema and configuration details.

---

### powerbi_list_reports
List reports within a Power BI workspace.

**Parameters:**
- `workspace_id` (string, required): The workspace (group) ID (a GUID).

**Returns:** Array of report objects with `id`, `name`, `webUrl`, `embedUrl`, `datasetId`, etc.

---

### powerbi_get_report
Get details for a specific report within a workspace.

**Parameters:**
- `workspace_id` (string, required): The workspace (group) ID (a GUID).
- `report_id` (string, required): The report ID (a GUID).

**Returns:** Report object with embed URL, description, and associated dataset.
