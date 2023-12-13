// functions.js
function showRightDiv(prodId, pharmId) {
    console.log("prod_id: ", prodId);
    console.log("pharm_id: ", pharmId);

    // Update URL with prodId and pharmId
    var url = window.location.href.split('?')[0]; // Get current URL without parameters
    if (prodId && pharmId) {
        var newUrl = `${url}?prodId=${prodId}&pharmId=${pharmId}`;
        history.pushState({}, '', newUrl); // Modify URL with prodId and pharmId
    }

    // Make an AJAX request to fetch the content for the catalog-right div
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var catalogRight = document.querySelector('.catalog-right');
                catalogRight.innerHTML = xhr.responseText;

                // Show the catalog-right div
                catalogRight.classList.add('visible');
            } else {
                console.error('Failed to fetch content');
            }
        }
    };

    xhr.open("GET", `fetch_content.php?prodId=${prodId}&pharmId=${pharmId}`, true);
    xhr.send();
}


function hideRightDiv() {
    // Remove prodId and pharmId from URL and hide rightDiv
    var url = window.location.href.split('?')[0]; // Get current URL without parameters
    history.replaceState({}, '', url); // Update URL without prodId and pharmId

    var rightDiv = document.querySelector('.catalog-right');
    if (rightDiv) {
        rightDiv.classList.remove('visible');
    }
}


function toggleFilters() {
    var filtBtm = document.querySelector('.filter-btm');
    filtBtm.classList.toggle('visible-grid');

}
