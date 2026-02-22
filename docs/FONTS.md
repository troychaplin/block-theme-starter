# Font Size Configuration

Custom font sizes are defined in `theme.json` under `settings.typography.fontSizes`. These replace the WordPress defaults (`defaultFontSizes: false`) and use WordPress's built-in fluid typography engine (`fluid: true`).

## Font Size Scale

| Name | Slug | Size (max) | Fluid Min | Fluid Max | Fluid? |
|---|---|---|---|---|---|
| Small | `small` | `0.875rem` (14px) | — | — | Auto |
| Medium | `medium` | `1.125rem` (18px) | `0.875rem` (14px) | `1.125rem` (18px) | Yes |
| Large | `large` | `1.75rem` (28px) | `1.25rem` (20px) | `1.75rem` (28px) | Yes |
| Extra Large | `x-large` | `2.25rem` (36px) | `1.5rem` (24px) | `2.25rem` (36px) | Yes |
| Extra Extra Large | `xx-large` | `3.25rem` (52px) | `2rem` (32px) | `3.25rem` (52px) | Yes |
| Extra Extra Extra Large | `xxx-large` | `4.5rem` (72px) | `2.5rem` (40px) | `4.5rem` (72px) | Yes |

## Heading Mapping

Font size presets are mapped to heading elements in `theme.json` styles:

| Element | Preset | Size |
|---|---|---|
| `h1` | `xxx-large` | 40px → 72px |
| `h2` | `xx-large` | 32px → 52px |
| `h3` | `x-large` | 24px → 36px |
| `h4` | `large` | 20px → 28px |
| `h5` | `medium` | 14px → 18px |
| `h6` | `medium` (italic) | 14px → 18px |
| Body | `medium` | 14px → 18px |

## How Fluid Typography Works

When `fluid` is enabled, WordPress generates a `clamp()` function that smoothly scales font sizes between a minimum and maximum viewport width (defaults to 320px and 1600px):

```css
/* Example: Large size output */
font-size: clamp(1.25rem, calc(1.25rem + ((1.75 - 1.25) * ((100vw - 320px) / 1280px))), 1.75rem);
                  ↑                                                                        ↑
                  min (mobile)                                                              max (desktop)
```

- **Below 320px viewport**: font locks at the `min` value
- **320px – 1600px**: font scales smoothly between `min` and `max`
- **Above 1600px**: font locks at the `max` value

## Fluid Range Breakdown

The growth percentage increases with size, so larger headings shrink more aggressively on mobile while body text stays stable.

| Name | Min (px) | Max (px) | Range | Growth | Typical Use |
|---|---|---|---|---|---|
| Small | 14 | 14 | — | — | Captions, labels, fine print |
| Medium | 14 | 18 | 4px | 28.6% | Body text, paragraphs (h5, h6) |
| Large | 20 | 28 | 8px | 40% | Subheadings (h4) |
| Extra Large | 24 | 36 | 12px | 50% | Section headings (h3) |
| Extra Extra Large | 32 | 52 | 20px | 62.5% | Section headings (h2) |
| Extra Extra Extra Large | 40 | 72 | 32px | 80% | Page titles (h1), hero text |

## Values at Common Breakpoints

Approximate rendered sizes across viewports:

| Name | 375px (Mobile) | 768px (Tablet) | 1280px (Desktop) | 1600px+ |
|---|---|---|---|---|
| Small | 14px | 14px | 14px | 14px |
| Medium | 14.2px | 15.4px | 17.2px | 18px |
| Large | 20.3px | 22.8px | 26.2px | 28px |
| Extra Large | 24.5px | 28.2px | 33.2px | 36px |
| Extra Extra Large | 32.9px | 38.9px | 47.2px | 52px |
| Extra Extra Extra Large | 41.4px | 52.2px | 65.5px | 72px |

## Note on Small Size

Small uses `"fluid": true` without an explicit min/max range. WordPress's fluid engine treats sizes at or below `0.875rem` as effectively static since they're at the minimum fluid threshold. This is intentional — small text should not shrink further on mobile.

## Font Family

The theme uses a system font stack, avoiding external font loading for optimal performance:

```
-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif
```

## Usage in Templates

WordPress generates CSS custom properties for each size:

```css
/* CSS custom property */
font-size: var(--wp--preset--font-size--large);

/* Resolves to the clamp() value */
font-size: clamp(1.25rem, calc(1.25rem + ...), 1.75rem);
```
