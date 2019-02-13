
public class FindMax implements Runnable { 
	private int start;
	private int end;
	private int[] A;
	private int max=0;
		
	public FindMax(int[] A, int start, int end) {
		this.start = start;
		this.end = end;
		this.A = A;
		
    }
    
	public void run() {
    	for (int i=start; i <=end; i++) {
    		
    		if (max<A[i])
    			max = A[i];
    	}
    	
    }
    public int getMax() {
    	return max; }
}








