export default function () {

  document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".introduction__information-btn");
    const panes = document.querySelectorAll(".introduction__information-pane");
    const tocTitles = document.querySelectorAll(".tour-toc__title");

    function syncTOCWithTabs(tabId) {
      tocTitles.forEach(title => title.classList.remove("active"));

      const matchingTitle = document.querySelector(`.tour-toc__title[href="#${tabId}"]`);
      if (matchingTitle) {
        matchingTitle.classList.add("active");
      }
    }

    buttons.forEach(button => {
      button.addEventListener("click", () => {
        const tabId = button.dataset.tab;

        buttons.forEach(btn => btn.classList.remove("active"));
        panes.forEach(pane => pane.classList.remove("active"));

        button.classList.add("active");
        document.getElementById(tabId).classList.add("active");

        syncTOCWithTabs(tabId);
      });
    });

    tocTitles.forEach(title => {
      title.addEventListener("click", (e) => {
        const href = title.getAttribute("href");
        const targetTabId = href.replace("#", "");

        const targetButton = document.querySelector(`.introduction__information-btn[data-tab="${targetTabId}"]`);

        if (targetButton) {
          e.preventDefault();
          targetButton.click();

          const tabsContainer = document.querySelector(".introduction__information-tabs");
          if (tabsContainer) {
            tabsContainer.scrollIntoView({ behavior: "smooth" });
          }
        }
      });
    });
  });
}