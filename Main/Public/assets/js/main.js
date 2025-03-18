class EventManager {
    constructor() {
        this.form = document.getElementById('eventForm');
        this.tableBody = document.getElementById('scheduleBody');
        this.setupEventListeners();
        this.setupTableHighlighting();
    }

    setupEventListeners() {
        this.form.addEventListener('submit', this.handleEventSubmit.bind(this));
        
        // Add input validation listeners
        const inputs = this.form.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('input', this.validateInput.bind(this));
            input.addEventListener('blur', this.validateInput.bind(this));
        });
    }

    setupTableHighlighting() {
        const today = new Date();
        const currentDay = today.getDay();
        
        // Highlight current day column
        const cells = document.querySelectorAll(`td:nth-child(${currentDay + 1})`);
        cells.forEach(cell => {
            cell.style.backgroundColor = 'rgba(76, 175, 80, 0.1)';
        });
    }

    validateInput(event) {
        const input = event.target;
        const value = input.value.trim();
        
        switch(input.id) {
            case 'event-name':
                this.validateEventName(input, value);
                break;
            case 'event-description':
                this.validateEventDescription(input, value);
                break;
            case 'schedule-date':
                this.validateDate(input, value);
                break;
        }
    }

    validateEventName(input, value) {
        if (value.length === 0) {
            this.showError(input, 'Event name is required');
        } else if (value.length > 255) {
            this.showError(input, 'Event name must be less than 255 characters');
        } else {
            this.clearError(input);
        }
    }

    validateEventDescription(input, value) {
        if (value.length === 0) {
            this.showError(input, 'Event description is required');
        } else if (value.length > 1000) {
            this.showError(input, 'Description must be less than 1000 characters');
        } else {
            this.clearError(input);
        }
    }

    validateDate(input, value) {
        const selectedDate = new Date(value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        if (!value) {
            this.showError(input, 'Date is required');
        } else if (selectedDate < today) {
            this.showError(input, 'Date cannot be in the past');
        } else {
            this.clearError(input);
        }
    }

    showError(element, message) {
        let errorDiv = element.nextElementSibling;
        if (!errorDiv || !errorDiv.classList.contains('error-message')) {
            errorDiv = document.createElement('div');
            errorDiv.classList.add('error-message');
            element.parentNode.insertBefore(errorDiv, element.nextSibling);
        }
        errorDiv.textContent = message;
        element.classList.add('error');
    }

    clearError(element) {
        const errorDiv = element.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('error-message')) {
            errorDiv.remove();
        }
        element.classList.remove('error');
    }

    showSuccess(message) {
        const successDiv = document.createElement('div');
        successDiv.classList.add('success-message');
        successDiv.textContent = message;
        this.form.insertBefore(successDiv, this.form.firstChild);
        
        setTimeout(() => {
            successDiv.remove();
        }, 3000);
    }

    async handleEventSubmit(event) {
        event.preventDefault();
        
        if (!this.validateForm()) {
            return;
        }

        const formData = this.getFormData();
        this.form.classList.add('loading');
        
        try {
            await this.submitEvent(formData);
            this.showSuccess('Event added successfully!');
            this.form.reset();
            this.addEventToTable(formData);
        } catch (error) {
            this.showError(this.form, 'Failed to add event. Please try again.');
        } finally {
            this.form.classList.remove('loading');
        }
    }

    validateForm() {
        const inputs = this.form.querySelectorAll('input');
        let isValid = true;
        
        inputs.forEach(input => {
            this.validateInput({ target: input });
            if (input.classList.contains('error')) {
                isValid = false;
            }
        });
        
        return isValid;
    }

    getFormData() {
        return {
            eventName: document.getElementById('event-name').value.trim(),
            eventDescription: document.getElementById('event-description').value.trim(),
            scheduleDate: document.getElementById('schedule-date').value
        };
    }

    async submitEvent(formData) {
        const response = await fetch('/event/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });

        if (!response.ok) {
            throw new Error('Failed to submit event');
        }

        return await response.json();
    }

    addEventToTable(data) {
        const newRow = document.createElement('tr');
        const eventCell = document.createElement('td');
        eventCell.innerHTML = `${this.escapeHtml(data.eventName)}<br>${this.escapeHtml(data.eventDescription)}`;
        newRow.appendChild(eventCell);
        
        const scheduleDate = new Date(data.scheduleDate);
        for (let i = 1; i <= 7; i++) {
            const cell = document.createElement('td');
            if (scheduleDate.getDay() + 1 === i) {
                cell.textContent = '✓';
            }
            newRow.appendChild(cell);
        }
        
        this.tableBody.appendChild(newRow);
    }

    escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new EventManager();
});

