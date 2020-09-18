using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class LoadingData : MonoBehaviour
{
    public void loadData(int gameId, int playerId, int highestLevel)
    {
        DataStorage.setGameId(gameId);
        DataStorage.setPlayerId(playerId);
        DataStorage.setHighestLevel(highestLevel);
    }

    public void initData()
    {
        DataSystem.resetNewLevel(1);
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {
        initData();
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
