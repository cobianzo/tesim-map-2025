import { useEffect } from 'react';
/**
 * useKeyPress
 * @param {string} key - the name of the key to respond to, compared against event.key
 * @param {function} action - the action to perform on key press
 * 
 * Usage:
 * useKeyPress('Escape', () => { 
        do whatever you want to do when escape is pressed
    }, [selected, projectInModal]);
 */
export default function useKeypress(key, action, dependencies = []) {
  useEffect(() => {
    function onKeyup(e) {
      if (e.key === key) action()
    }
    window.addEventListener('keyup', onKeyup);
    return () => window.removeEventListener('keyup', onKeyup);
  }, dependencies);
}