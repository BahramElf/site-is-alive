// wpex-sia-front-js.js
document.addEventListener("DOMContentLoaded", function () {
    const timestampElement = document.getElementById("wpex-sia-timestamp");
    const messageElement = document.getElementById("wpex-sia-message-text");
    const messageContainer = document.getElementById("wpex-sia-message");

    if (!timestampElement || !messageElement || !messageContainer || typeof wpexSiaPhpData === "undefined") {
        console.error("WPEX-SIA plugin - Required elements or data are missing.");
        return;
    }

    // Apply styles to message container
    messageContainer.style.color = wpexSiaPhpData.textColor || '#000000';
    messageContainer.style.backgroundColor = wpexSiaPhpData.backgroundColor || '#ffffff';
    messageContainer.style.borderColor = wpexSiaPhpData.borderColor || 'transparent';
    messageContainer.style.fontSize = `${wpexSiaPhpData.fontSize || 1}rem`;
    messageContainer.style.borderWidth = `${wpexSiaPhpData.borderWith || 0}px`;
    messageContainer.style.borderRadius = `${wpexSiaPhpData.borderRadius || 0}px`;
    messageContainer.style.padding = `${wpexSiaPhpData.padding || 0}px`;
    messageContainer.style.borderStyle = wpexSiaPhpData.borderStyle ? 'solid' : 'none';


    function formatDate(date, calendarType) {
        switch (calendarType) {
            case 'solar_hijri':
                return new Intl.DateTimeFormat('fa-IR-u-ca-persian', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                }).format(date);
            case 'lunar_hijri':
                return new Intl.DateTimeFormat('ar-SA-u-ca-islamic', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                }).format(date);
            default:
                return date.toLocaleDateString(undefined, {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                });
        }
    }

    try {
        const now = new Date();
        let displayParts = [];
        if (wpexSiaPhpData.displayDate) {
            const calendarType = wpexSiaPhpData.calendarType || 'gregorian';
            const formattedDate = formatDate(now, calendarType);
            displayParts.push(formattedDate);
        }
        if (wpexSiaPhpData.displayTime) {
            const formattedTime = now.toLocaleTimeString(undefined, {
                hour: '2-digit', // 2-digit hour in 24-hour format
                minute: '2-digit', // 2-digit minute
                //second: '2-digit', // 2-digit second (optional)
                hour12: false,     // Disable 12-hour format (AM/PM)
            });
            displayParts.push(formattedTime);
        }

        if (displayParts.length === 0) {
            timestampElement.style.display = 'none';
        } else {
            timestampElement.textContent = displayParts.join(' - ') + ' - ';
        }

        if (wpexSiaPhpData.displayMessage) {
            messageElement.textContent = wpexSiaPhpData.message || "The site is alive!";
        } else {
            messageElement.style.display = 'none';
        }
    } catch (error) {
        console.error("WPEX-SIA plugin - Error formatting date/time:", error);
    }
});

