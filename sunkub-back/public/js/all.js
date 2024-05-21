function showpage(){
    document.getElementById('loaditem').style.display = 'none';
    document.getElementById('pagecontent').style.display = 'block';
}

function activeshowpage() {
    let content = setTimeout(showpage,500);
}

// Function to get current time in hours and minutes
function getCurrentTime() {
    const now = new Date();
    const hours = now.getHours();
    const minutes = now.getMinutes();
    return hours * 60 + minutes; // Convert time to minutes for easier comparison
}

// Function to determine market status based on current time
function getMarketStatus() {
    const currentTime = getCurrentTime();
    const marketOpenTime = 21 * 60; // Market opens at 9:30 PM (converted to minutes)
    const marketCloseTime = 4 * 60; // Market closes at 4:00 AM (next day) (converted to minutes)

    const now = new Date();
    const dayOfWeek = now.getDay(); // วันในสัปดาห์ (0 = วันอาทิตย์, 1 = วันจันทร์, ..., 6 = วันเสาร์)

    // เช็คว่าเป็นวันจันทร์ถึงศุกร์หรือไม่และเวลาอยู่ระหว่างช่วงเปิด-ปิดตลาดหุ้นหรือไม่
    if(dayOfWeek >= 1 && dayOfWeek <= 5){
        if(currentTime >= marketOpenTime){
            return {
                status: 'Market is open',
                colorClass: 'market-open'
            };
        }
        else if(currentTime>=0 && currentTime <= marketCloseTime){
            return {
                status: 'Market is open',
                colorClass: 'market-open'
            }; 
        }
        else{
            return {
                status: 'Market is closed',
                colorClass: 'market-closed'
            };
        }
    }
}

// Function to update market status every minute
function updateMarketStatus() {
    const marketStatusElement = document.getElementById('market-status');
    const marketStatus = getMarketStatus();

    marketStatusElement.textContent = marketStatus.status; // Set market status text

    // Remove existing classes
    marketStatusElement.classList.remove('market-open', 'market-closed');

    // Add appropriate class based on market status
    marketStatusElement.classList.add(marketStatus.colorClass);

    // Update every minute
    setTimeout(updateMarketStatus, 60000);
}


