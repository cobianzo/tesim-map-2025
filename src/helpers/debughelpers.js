// Helpers. Creator of tooltip for every region
export function createAnchoredTooltip(id, text = null) {
  const target = document.getElementById(id);
  if (!target) {
    console.warn(`Elemento con id "${id}" no encontrado.`);
    return;
  }

  // Evitar duplicados
  const existing = document.querySelector(`[data-tooltip-for="${id}"]`);
  if (existing) existing.remove();

  // Aplicar el ancla al target
  target.style.anchorName = "--anchor-" + id;

  // Crear el tooltip
  const tooltip = document.createElement("div");
  tooltip.id = "tooltip-" + id;
  tooltip.textContent = text || target.title || id;
  tooltip.setAttribute("data-tooltip-for", id);
  tooltip.className = "anchored-tooltip";

  // Aplicar estilos requeridos por Anchor Positioning
  Object.assign(tooltip.style, {
    position: "absolute",
    left: "50%",
    top: "50%",
    transform: "translate(-50%, -50%)",
    background: "rgba(0,0,0,0.85)",
    color: "#fff",
    padding: "4px 8px",
    borderRadius: "4px",
    fontSize: "12px",
    zIndex: 1000,
    pointerEvents: "none",
  });

  // Position the tooltip in the center of the target element
  const targetRect = target.getBoundingClientRect();
  tooltip.style.position = "fixed";
  tooltip.style.left = `${targetRect.left + targetRect.width / 2}px`;
  tooltip.style.top = `${targetRect.top + targetRect.height / 2}px`;
  tooltip.style.transform = "translate(-50%, -50%)";

  document.body.appendChild(tooltip);
}
