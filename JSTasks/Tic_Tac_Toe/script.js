const x_image_path = "./images/x_image.png";
const o_image_path = "./images/o_image.png";
const background_image = "./images/white_background.png";
const msg_id = "msg";
const player_symbol = "x";
const bot_symbol = "o";
const restart_id = "restart_button";
const max_row = 3;
const max_col = 3;

const cells_id = [
    ["row_1_col_1", "row_1_col_2", "row_1_col_3"],
    ["row_2_col_1", "row_2_col_2", "row_2_col_3"],
    ["row_3_col_1", "row_3_col_2", "row_3_col_3"]
];

let cells = [
    ["", "", ""],
    ["", "", ""],
    ["", "", ""]
];

let scores = {
    player_symbol: -1,
    bot_symbol: 1,
    none: 0
}

for (let i = 0; i < max_row; i++) {
    for (let j = 0; j < max_col; j++) {
        add_move(i, j);
    }
};

document.getElementById(restart_id).addEventListener("click", function() {
    for (let i = 0; i < max_row; i++) {
        for (let j = 0; j < max_col; j++) {
            cells[i][j] = "";
            document.getElementById(cells_id[i][j]).src = background_image;
        }
    }

});


function add_move(i, j) {
    document.getElementById(cells_id[i][j]).addEventListener("click", function() {

        document.getElementById(msg_id).innerText = "";

        if (!check_free_cell()) {
            document.getElementById(msg_id).innerText = "Game over!";
            return;
        }

        if (cells[i][j] !== "") {
            document.getElementById(msg_id).innerText = "Please, select valid cell.";
            return;
        }
        cells[i][j] = player_symbol;
        document.getElementById(cells_id[i][j]).src = x_image_path;

        let winner = check_for_winner();
        if (winner) {
            if (winner === player_symbol) {
                document.getElementById(msg_id).innerText = "Congratulations! You win.";
                lock_all_cells();

            } else if (winner === bot_symbol) {
                document.getElementById(msg_id).innerText = "Sorry! You lost.";
                lock_all_cells();
            }
        } else if (winner === null) {
            document.getElementById(msg_id).innerText = "Game over!";
            lock_all_cells();
        } else {
            const move = move_bot();
            const row = move.i;
            const col = move.j;
            cells[row][col] = bot_symbol;
            document.getElementById(cells_id[row][col]).src = o_image_path;
            winner = check_for_winner();
            if (winner && winner === bot_symbol) {
                document.getElementById(msg_id).innerText = "Sorry! You lost.";
                lock_all_cells();
            }
        }
    });
}

function lock_all_cells() {
    for (let i = 0; i < max_row; i++) {
        for (let j = 0; j < max_col; j++) {
            if (cells[i][j] === "") {
                cells[i][j] = "lock";
            }
        }
    }
}

function check_free_cell() {
    for (let i = 0; i < max_row; i++) {
        for (let j = 0; j < max_col; j++) {
            if (cells[i][j] === "") {
                return true;
            }
        }
    }
    return false;
}

function check_for_winner() {
    let move = null;
    for (let i = 0; i < max_row; i++) {
        if (cells[i][0] !== "" &&
            cells[i][0] === cells[i][1] &&
            cells[i][1] === cells[i][2]) {
            move = cells[i][0];
        }
    }

    for (let i = 0; i < max_col; i++) {
        if (cells[0][i] !== "" &&
            cells[0][i] === cells[1][i] &&
            cells[1][i] === cells[2][i]) {
            move = cells[0][i];
        }
    }

    if (cells[0][0] !== "" &&
        cells[0][0] === cells[1][1] &&
        cells[1][1] === cells[2][2]) {
        move = cells[0][0];
    }
    if (cells[0][2] !== "" &&
        cells[0][2] === cells[1][1] &&
        cells[1][1] === cells[2][0]) {
        move = cells[0][2];
    }

    for (let i = 0; i < max_row; i++) {
        for (let j = 0; j < max_col; j++) {
            if (cells[i][j] === "" && move === null) {
                move = false;
            }
        }
    }
    return move;
}


function move_bot() {

    let bestScore = -Infinity;
    let move = { "row": "", "col": "" };

    for (let i = 0; i < max_row; i++) {
        for (let j = 0; j < max_col; j++) {
            if (cells[i][j] === "") {
                cells[i][j] = bot_symbol;
                let score = minimax(cells, 0, false);
                cells[i][j] = "";
                if (score > bestScore) {
                    bestScore = score;
                    move["row"] = i;
                    move["col"] = j;
                };
            }
        }
    }
    return {
        i: move["row"],
        j: move["col"]
    }
}

function minimax(cells, depth, minimazing) {
    let winner = check_for_winner();
    if (winner || winner === null) {
        if (winner === player_symbol) {
            return scores["player_symbol"];
        } else if (winner === bot_symbol) {
            return scores["bot_symbol"];
        } else {
            return scores["none"];
        }

    }

    if (minimazing) {
        let bestScore = -Infinity;
        for (let i = 0; i < max_row; i++) {
            for (let j = 0; j < max_col; j++) {

                if (cells[i][j] === "") {
                    cells[i][j] = bot_symbol;
                    let score = minimax(cells, depth + 1, false);
                    cells[i][j] = "";
                    bestScore = Math.max(score, bestScore);
                }
            }
        }
        return bestScore;
    } else {
        let bestScore = Infinity;
        for (let i = 0; i < max_row; i++) {
            for (let j = 0; j < max_col; j++) {
                if (cells[i][j] === "") {
                    cells[i][j] = player_symbol;
                    let score = minimax(cells, depth + 1, true);
                    cells[i][j] = "";
                    bestScore = Math.min(score, bestScore);
                }
            }
        }
        return bestScore;
    }
}