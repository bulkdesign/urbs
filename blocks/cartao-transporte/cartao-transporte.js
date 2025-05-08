(() => {
	// Run immediately, but check if DOM is ready
	const runTabsInit = function () {
		// Main tabs functionality
		const mainTabButtons = document.querySelectorAll(
			".cartao-transporte-tabs .tablink"
		);
		const mainTabPanels = document.querySelectorAll(
			'.cartao-transporte-list-item[role="tabpanel"]'
		);

		// Add click event to each main tab button
		mainTabButtons.forEach((button) => {
			button.addEventListener("click", function () {
				// Deselect all main tab buttons
				mainTabButtons.forEach((btn) => {
					btn.setAttribute("aria-selected", "false");
				});

				// Select the clicked button
				this.setAttribute("aria-selected", "true");

				// Hide all main tab panels
				mainTabPanels.forEach((panel) => {
					panel.hidden = true;
				});

				// Show the corresponding panel
				const panelId = this.id;
				const panel = document.querySelector(`[aria-labelledby="${panelId}"]`);
				if (panel) {
					panel.hidden = false;
				}

				// Scroll the tab into view (for mobile)
				if (window.innerWidth <= 1199) {
					this.scrollIntoView({
						behavior: "smooth",
						block: "nearest",
						inline: "start",
					});
				}
			});
		});

		// Inner tabs functionality (for each tab panel)
		document
			.querySelectorAll(".cartao-transporte-informacoes-wrapper")
			.forEach((wrapper) => {
				const innerTabButtons = wrapper.querySelectorAll(
					".cartao-transporte-informacoes-tabs .informacoesTab"
				);
				const innerTabPanels = wrapper.querySelectorAll(
					".cartao-transporte-informacoes-tabs-content"
				);

				// Add click event to each inner tab button
				innerTabButtons.forEach((button) => {
					button.addEventListener("click", function () {
						// Deselect all inner tab buttons in this wrapper
						innerTabButtons.forEach((btn) => {
							btn.setAttribute("aria-selected", "false");
						});

						// Select the clicked button
						this.setAttribute("aria-selected", "true");

						// Hide all inner tab panels in this wrapper
						innerTabPanels.forEach((panel) => {
							panel.hidden = true;
						});

						// Show the corresponding panel
						const panelId = this.id;
						const panel = wrapper.querySelector(
							`[aria-labelledby="${panelId}"]`
						);
						if (panel) {
							panel.hidden = false;
						}

						// Scroll the tab into view (for mobile)
						if (window.innerWidth <= 1199) {
							this.scrollIntoView({
								behavior: "smooth",
								block: "nearest",
								inline: "start",
							});
						}
					});
				});
			});

		// Set first tab as active by default (if not already set in HTML)
		if (mainTabButtons.length > 0 && mainTabPanels.length > 0) {
			// Check if any tab is already selected
			const anySelected = Array.from(mainTabButtons).some(
				(btn) => btn.getAttribute("aria-selected") === "true"
			);

			if (!anySelected) {
				mainTabButtons[0].setAttribute("aria-selected", "true");
				if (mainTabPanels[0]) {
					mainTabPanels[0].hidden = false;
				}
			}
		}
	};

	// Run the initialization function
	runTabsInit();
})();
