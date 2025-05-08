(() => {
	if (!document.querySelectorAll(".cartao-transporte").length) return false;

	// Function to initialize tabs
	function initializeTabs(tabContainer, tabButtonSelector, tabPanelSelector) {
		// Select all elements with the role 'tab' within the selected tab container
		const tabButtons = tabContainer.querySelectorAll(tabButtonSelector);

		// Function to handle tab click events
		function tabClickHandler(e) {
			// Get the parent tablist container
			const tablistContainer = e.currentTarget.closest('[role="tablist"]');

			// Get all tab buttons and panels within this tablist
			const currentTabButtons =
				tablistContainer.querySelectorAll(tabButtonSelector);
			const currentTabPanels = Array.from(
				tablistContainer.querySelectorAll(tabPanelSelector)
			);

			// Hide all tab panels in this tablist
			currentTabPanels.forEach((panel) => {
				panel.hidden = true; // Set hidden attribute to true
			});

			// Deselect all tab buttons in this tablist
			currentTabButtons.forEach((button) => {
				button.setAttribute("aria-selected", "false"); // Set aria-selected attribute to false
			});

			// Select the clicked tab button
			e.currentTarget.setAttribute("aria-selected", "true");

			// Scroll the tab into view (for mobile)
			if (window.innerWidth <= 1199) {
				// Use scrollIntoView with options to make it smooth and position at start
				e.currentTarget.scrollIntoView({
					behavior: "smooth",
					block: "nearest",
					inline: "start",
				});
			}

			// Get the id of the clicked tab button
			const { id } = e.currentTarget;

			// Find the corresponding tab panel for the clicked tab button
			const currentTab = currentTabPanels.find(
				(panel) => panel.getAttribute("aria-labelledby") === id
			);

			// Show the corresponding tab panel
			if (currentTab) {
				currentTab.hidden = false; // Set hidden attribute to false
			}
		}

		// Add click event listener to each tab button
		tabButtons.forEach((button) => {
			button.addEventListener("click", tabClickHandler);
		});

		// Make the first tab and panel active by default in each tablist
		const tablists = tabContainer.querySelectorAll('[role="tablist"]');
		tablists.forEach((tablist) => {
			const firstButton = tablist.querySelector(tabButtonSelector);
			if (firstButton) {
				firstButton.setAttribute("aria-selected", "true");
				const firstPanelId = firstButton.id;
				const firstPanel = tabContainer.querySelector(
					`[aria-labelledby="${firstPanelId}"]`
				);
				if (firstPanel) {
					firstPanel.hidden = false;
				}
			}
		});
	}

	// Initialize main tabs
	const cartaoTransporte = document.querySelector(".cartao-transporte");
	initializeTabs(
		cartaoTransporte,
		'.cartao-transporte-tabs [role="tab"]',
		'.cartao-transporte-list-item[role="tabpanel"]'
	);

	// Initialize inner tabs (informacoes)
	document
		.querySelectorAll(".cartao-transporte-informacoes-wrapper")
		.forEach((wrapper) => {
			initializeTabs(
				wrapper,
				'.cartao-transporte-informacoes-tabs .informacoesTab[role="tab"]',
				'.cartao-transporte-informacoes-tabs-content[role="tabpanel"]'
			);
		});
})();
