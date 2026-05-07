# Stability AI Lua API Reference

Namespace: `app.integrations.stability`

Use this integration for Stability AI account checks plus image generation, image editing, upscaling, control, and image-to-video jobs. Binary image or video responses are normalized as:

```lua
{
  content_type = "image/png",
  body_base64 = "...",
  finish_reason = "SUCCESS",
  seed = "123"
}
```

## Account

- `get_account({})` reads the API key account.
- `get_balance({})` reads available credits.

## Image Generation

```lua
local image = app.integrations.stability.generate_core({
  prompt = "product photo of a matte black desk lamp",
  aspect_ratio = "1:1",
  output_format = "png"
})
```

Available generation tools:

- `generate_core`
- `generate_ultra`
- `generate_sd3`

`generate_sd3` also accepts `model`, such as `sd3.5-large` or `sd3.5-medium`.

## Image Editing And Control

File inputs may be local paths or raw image bytes. Common tools:

- `inpaint({ image, prompt, mask, negative_prompt, seed, output_format })`
- `erase({ image, mask, output_format })`
- `remove_background({ image, output_format })`
- `control_structure({ image, prompt, control_strength, negative_prompt, seed, output_format })`

```lua
local result = app.integrations.stability.remove_background({
  image = "/tmp/product.png",
  output_format = "png"
})
```

## Upscaling

```lua
local fast = app.integrations.stability.upscale_fast({
  image = "/tmp/small.png",
  output_format = "png"
})
```

Use `upscale_creative` when the model should add detail from a prompt.

## Image To Video

```lua
local job = app.integrations.stability.image_to_video({
  image = "/tmp/hero.png",
  motion_bucket_id = 127
})

local video = app.integrations.stability.get_video_result({
  id = job.id
})
```

The result endpoint may return an in-progress JSON status or final video bytes, depending on the Stability API response.
