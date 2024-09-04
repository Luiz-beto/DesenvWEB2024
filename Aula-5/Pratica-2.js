
function addTotalRow() {
    const table = document.querySelector('table');
    const rows = table.querySelectorAll('tbody tr');
    const noteTotals = Array(9).fill(0); 
    const noteCounts = Array(9).fill(0); 


    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        cells.forEach((cell, index) => {
            if (index > 0 && index < 10) { 
                const note = parseFloat(cell.textContent);
                if (!isNaN(note)) {
                    noteTotals[index - 1] += note;
                    noteCounts[index - 1]++;
                }
            }
        });
    });

    const noteAverages = noteTotals.map((total, index) => total / noteCounts[index]);


    const tfoot = table.createTFoot();
    const footerRow = document.createElement('tr');
    footerRow.innerHTML = `
        <th>Média</th>
        ${noteAverages.map(avg => `<td>${avg.toFixed(2)}</td>`).join('')}
        <td></td> 
    `;
    tfoot.appendChild(footerRow);
}


function addTotalColumn() {
    const table = document.querySelector('table');
    const rows = table.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let total = 0;
        let count = 0;

        cells.forEach((cell, index) => {
            if (index > 0 && index < 10) { 
                const note = parseFloat(cell.textContent);
                if (!isNaN(note)) {
                    total += note;
                    count++;
                }
            }
        });

        const average = count > 0 ? total / count : 0;
        
        row.innerHTML += `<td>${average.toFixed(2)}</td>`;
    });

    
}

document.querySelectorAll('button')[0].addEventListener('click', addTotalRow);
document.querySelectorAll('button')[1].addEventListener('click', addTotalColumn);

