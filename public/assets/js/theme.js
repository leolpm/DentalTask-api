;(function () {
  const THEME_KEY = 'phoenixTheme'

  const getPreferredTheme = () => {
    const stored = localStorage.getItem(THEME_KEY)
    if (stored) return stored
    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
      ? 'dark'
      : 'light'
  }

  const applyTheme = (theme) => {
    const html = document.documentElement
    const resolved =
      theme === 'auto'
        ? (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
        : theme
    html.setAttribute('data-theme', theme)
    html.setAttribute('data-bs-theme', resolved)
  }

  const storeTheme = (theme) => {
    localStorage.setItem(THEME_KEY, theme)
  }

  const toggleTheme = () => {
    const current = localStorage.getItem(THEME_KEY) || 'light'
    const next = current === 'dark' ? 'light' : 'dark'
    storeTheme(next)
    applyTheme(next)
  }

  document.addEventListener('DOMContentLoaded', () => {
    const current = getPreferredTheme()
    storeTheme(current)
    applyTheme(current)
    document.querySelectorAll('[data-theme-control="theme"]').forEach((el) => {
      el.addEventListener('click', (e) => {
        e.preventDefault()
        toggleTheme()
      })
    })
  })
})()
