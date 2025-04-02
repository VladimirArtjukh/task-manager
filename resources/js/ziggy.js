const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"tasks.index":{"uri":"api\/tasks","methods":["GET","HEAD"]},"tasks.store":{"uri":"api\/tasks","methods":["POST"]},"tasks.show":{"uri":"api\/tasks\/{task}","methods":["GET","HEAD"],"parameters":["task"]},"tasks.update":{"uri":"api\/tasks\/{task}","methods":["PUT","PATCH"],"parameters":["task"],"bindings":{"task":"id"}},"tasks.destroy":{"uri":"api\/tasks\/{task}","methods":["DELETE"],"parameters":["task"],"bindings":{"task":"id"}},"tasks.toggle":{"uri":"api\/tasks\/{task}\/toggle","methods":["POST"],"parameters":["task"],"bindings":{"task":"id"}},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
