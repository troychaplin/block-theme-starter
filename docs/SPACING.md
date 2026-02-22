# Spacing Configuration

Custom spacing sizes are defined in `theme.json` under `settings.spacing.spacingSizes`. These replace the WordPress defaults (`defaultSpacingSizes: false`).

## Spacing Scale

| Name | Slug | Size | Fluid? |
|---|---|---|---|
| 2X-Small | `20` | `0.25rem` (4px) | No |
| X-Small | `30` | `0.5rem` (8px) | No |
| Small | `40` | `min(0.75rem, 1vw)` | Yes |
| Medium | `50` | `min(1.5rem, 2vw)` | Yes |
| Large | `60` | `min(2.25rem, 3vw)` | Yes |
| X-Large | `70` | `min(3rem, 4vw)` | Yes |
| 2X-Large | `80` | `min(4.5rem, 6vw)` | Yes |

## How `min()` Works

The `min()` function picks whichever value is smaller. This creates fluid spacing that scales with the viewport on narrow screens but caps at a fixed `rem` value on wider screens.

```
min(1.5rem, 2vw)
     ↑        ↑
     cap      scales with viewport
```

- **Wide viewports** (1200px+): the `vw` value exceeds the `rem` cap, so the `rem` value is used
- **Narrow viewports** (below ~1200px): the `vw` value is smaller, so spacing shrinks proportionally

## Crossover Point

All fluid sizes share a consistent crossover at approximately **1200px**, which aligns with the theme's `wideSize` of 1280px. Below this width, spacing scales down proportionally.

The `vw` multiplier follows a ratio of roughly `rem value × 1.33`:

| Size | rem | vw | Crossover |
|---|---|---|---|
| Small | 0.75rem (12px) | 1vw | 1200px |
| Medium | 1.5rem (24px) | 2vw | 1200px |
| Large | 2.25rem (36px) | 3vw | 1200px |
| X-Large | 3rem (48px) | 4vw | 1200px |
| 2X-Large | 4.5rem (72px) | 6vw | 1200px |

## Values at Common Breakpoints

| Name | 375px (Mobile) | 768px (Tablet) | 1200px+ (Desktop) |
|---|---|---|---|
| 2X-Small | 4px | 4px | 4px |
| X-Small | 8px | 8px | 8px |
| Small | 3.75px | 7.68px | 12px |
| Medium | 7.5px | 15.36px | 24px |
| Large | 11.25px | 23.04px | 36px |
| X-Large | 15px | 30.72px | 48px |
| 2X-Large | 22.5px | 46.08px | 72px |

## Why Fixed for 2X-Small and X-Small?

At 4px and 8px these values are already minimal. Scaling them further on mobile would make them imperceptible, so they remain fixed `rem` values.

## Usage in Templates

WordPress generates CSS custom properties from these sizes. Use them in block markup via the spacing controls or reference them directly:

```css
/* CSS custom property */
padding: var(--wp--preset--spacing--50);

/* Resolves to */
padding: min(1.5rem, 2vw);
```
