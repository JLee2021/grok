const { app, BrowserWindow } = require('electron');

const createWindow = () => {
    const win = new BrowserWindow({
      width: 800,
      height: 600
    })
  
    // win.loadFile('index.html')
    win.loadURL('https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/index.php/Home2/index')
  }

  app.whenReady().then(() => {
    createWindow()
  });