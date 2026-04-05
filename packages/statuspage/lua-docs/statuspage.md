# Statuspage Integration

Lua API reference for the `statuspage` integration package.

## Functions

### `statuspage_list_incidents`

List all incidents for your Statuspage.

```lua
local result = statuspage_list_incidents()
print(result)
```

### `statuspage_create_incident`

Create a new incident on your Statuspage.

```lua
local result = statuspage_create_incident()
print(result)
```

### `statuspage_update_incident`

Update an existing incident on your Statuspage.

```lua
local result = statuspage_update_incident()
print(result)
```

### `statuspage_list_components`

List all components on your Statuspage.

```lua
local result = statuspage_list_components()
print(result)
```

### `statuspage_get_current_user`

Get the currently authenticated Statuspage user.

```lua
local result = statuspage_get_current_user()
print(result)
```

## Multi-Account Usage

Use namespace prefix:
```lua
local result = ns_statuspage_account1.statuspage_list_incidents()
```
