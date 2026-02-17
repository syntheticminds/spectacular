const Ziggy = {"url":"https:\/\/www.spectacular.test","port":null,"defaults":{},"routes":{"export.html":{"uri":"export\/{project}\/html","methods":["GET","HEAD"],"parameters":["project"]},"export.markdown":{"uri":"export\/{project}\/markdown","methods":["GET","HEAD"],"parameters":["project"],"bindings":{"project":"id"}}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
